<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Mail;

class UserController extends Controller
{
    private $user;
    // public function __construct(User $user)
    // {
    //     $this->user = $user;
    // }
    public function login(){
        return view('User.Login');
    }

       


    public function loginPost(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=> 'required|min:6'
        ]);
        if($validator->fails()){
            $request->session()->flash('errors', $validator->errors());
            return redirect()->back()->withInput( $request->except('password'));
        }
        else{
             $account = User::checkAccount($request->email);
            if($account === null){
                $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
                return redirect()->back()->withInput($request->except('password'));
            }
            else{
                if(Hash::check($request->password, $account->password)){
                 if(Auth::attempt(['email' => $request->email, 'password'=> $request->password ])){
                     if(Auth::user()->email_verified_at == 1){
                        return redirect('/')->with('success', 'Đăng nhập thành công');
                     }
                     else {
                        return redirect()->back()->with('error', 'Vui lòng xác thực email để đăng nhập!');
                     }
                 }
                 else {
                     return 'fails';
                 }
                }   
                else{
                    $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
                    return redirect()->back()->withInput($request->except('password'));
                }
            }

        }
    }

    public function signUp(){
        return view('User.SignUp');
    }

    public function signUpPost(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'age'=> 'required|numeric',
            'email'=> 'required|email',
            'password'=>'min:6',
        ]);
        if($validator->fails()) {
            $request->session()->flash('errors', $validator->errors());
            return redirect()->back()->withInput(
                $request->except('password')
            );
        }
        //send mail
        $data = array('token'=> $request['_token'], 'email' => $request['mail'] );
        $mail = $request['email'];
        Mail::send('mail', $data,  function($message) use($mail) {
           $message->to($mail, 'Tutorials Point')->subject
              ('Confirm Email');
           $message->from('taiphotographer6798@gmail.com','Admin');
        });
        echo "HTML Email Sent. Check your inbox.";


        //   //lưu xuống database
            User::createAccount($request);
            return redirect('/Login')->with('success', 'Bạn đã tạo tài khoản thành công, Vui lòng check mail để xác thực');
}

    public function logOut(Request $request){
        Auth::logout();
        return redirect('/Login');
    }

    public function conFirm($token){
        $check = User::conFirm($token);
        if($check == 'error'){
            return redirect('/Login')->with('error', 'Token xác thưc không chính xác');
        }
        else{
            return redirect('/Login')->with('success', 'Xác thực thành công. Vui lòng đăng nhập');
        }
    }
}
