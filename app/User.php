<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $table    = 'users';
    protected $fillable =  ['Name', 'Age', 'Email', 'Password', 'role'];

    public function products(){
        return $this->hasMany('App\Products');
    }

   public static function createAccount($request){
       $account = new User();
       $account->name = $request['name'];
       $account->age = $request['age'];
       $account->email = $request['email'];
       $account->remember_token	 = $request['_token'];
       $account->email_verified_at = 0;
       $account->password = Hash::make($request['password']);
       $account->role = 0;
    //    $account->remember_token = '';
       $account->save();

   }

   public static function checkAccount($Email){
       $account = User::all()->where('email', $Email)->first();
       return $account;
   }


   public static function conFirm($token){
       $account = User::all()->where('remember_token', $token)->first();
       if($account == null){
        return 'error';
       }
       else{
            $account->email_verified_at = 1;
            $account->remember_token = null;
            $account->save();
            return 'success';
        dd('token chinh xac');
       }
   }
}
