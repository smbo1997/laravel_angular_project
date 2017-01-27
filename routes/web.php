<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function (){
    return view('home');
});

Auth::routes();

Route::get('/pay', 'TestController@showform');
Route::post('/paywithcard', 'TestController@paywithcard');


Route::post('/insertdata', 'TestController@insertdata');
Route::post('/deleteproduct', 'TestController@deleteproduct');
Route::post('/updateproduct', 'TestController@updateproduct');


Route::get('/carusel', 'TestController@carusel');
Route::get('/mycarusel', function (){
    return view('mycarusel');
});
Route::get('/bootstrapcarusel', function (){
    return view('bootstrapcarusel');
});

Route::get('/upload', 'TestController@upload');

Route::get('/chat', 'ChatController@showchat');


