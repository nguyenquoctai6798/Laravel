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

   public static function createAccount($request){
       $account = new User();
       $account->name = $request['name'];
       $account->age = $request['age'];
       $account->email = $request['email'];
       $account->password = Hash::make($request['password']);
       $account->role = 0;
    //    $account->remember_token = '';
       $account->save();

   }

   public static function checkAccount($Email){
       $account = User::all()->where('email', $Email)->first();
       return $account;
   }
}
