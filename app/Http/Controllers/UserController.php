<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
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
            return redirect()->back();
        }
        else{
     

            // dd($data);
              
             $account = User::checkAccount($request->email);
            if($account === null){
                $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
                return redirect()->back();
            }
            else{
                if(Hash::check($request->password, $account->password)){
                 if(Auth::attempt(['email' => $request->email, 'password'=> $request->password ])){
                    return redirect('/')->with('success', 'Đăng nhập thành công');
                 }
                 else {
                     return 'fails';
                 }
                }
                else{
                    $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác2');
                    return redirect()->back();
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
            return redirect()->back();
        }
            User::createAccount($request);
            return redirect('/Login')->with('success', 'Bạn đã tạo tài khoản thành công, Vui lòng đăng nhập');
  
}

    public function logOut(Request $request){
        Auth::logout();
        return redirect('/Login');
    }
}
