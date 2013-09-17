<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', array(
    'as' => 'main',
    'uses' => 'HomeController@index'
));

/* Obrazki */
Route::get('images', array(
    'as' => 'images',
    'uses' => 'ImageController@index'
));

Route::post('upload', array(
    'uses' => 'ImageController@upload'
));

Route::get('show/{id}', array(
    'as' => 'show_image',
    'uses' => 'ImageController@show'
));

Route::delete('user/image/destroy/{id}', array(
    'uses' => 'ImageController@destroy'
))->before('auth');

/* Logowanie */
Route::post('login', array(
    'uses' => 'UserController@login'
));

Route::get('logout', array(
    'as' => 'logout',
    'uses' => 'UserController@logout'
))->before('auth');

/* Rejestracja */
Route::get('register', array(
    'as' => 'show_register',
    'uses' => 'UserController@showRegister'
))->before('guest');

Route::post('register-user', array(
    'uses' => 'UserController@register'
))->before('guest');

/* Konto uzytkownika */
Route::get('user/images', array(
    'as' => 'images_user',
    'uses' => 'UserController@showImages'
))->before('auth');

//Votes
Route::get('vote/{image_id}/{vote}', array(
    'as' => 'vote',
    'uses' => 'VoteController@vote'
))->before('auth');
