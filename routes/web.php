<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index');

Route::get('/DeleteProduct/{id}', 'HomeController@deleteProduct');
    
Route::get('/EditProduct/{id}', 'HomeController@editProduct');
    
Route::post('/EditProduct/{id}', 'HomeController@editProductPost');
    
Route::get('/CreateProduct', 'HomeController@createProduct');
    
Route::post('/CreateProduct', 'HomeController@creteProductPost');
    
Route::get('/ShowProductDetail/{id}', 'HomeController@showProductDetail');

Route::get('/Login', 'UserController@login');

Route::post('/Login', 'UserController@loginPost');

Route::get('/SignUp', 'UserController@signUp');

Route::post('/SignUp', 'UserController@signUpPost');

Route::get('/Logout', 'UserController@logOut');

Route::get('/Confirm/{token}', 'UserController@conFirm');
