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

/* Images */
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

/* Login */
Route::post('login', array(
    'uses' => 'UserController@login'
));

Route::get('logout', array(
    'as' => 'logout',
    'uses' => 'UserController@logout'
))->before('auth');

/* Register */
Route::get('register', array(
    'as' => 'show_register',
    'uses' => 'UserController@showRegister'
))->before('guest');

Route::post('register-user', array(
    'uses' => 'UserController@register'
))->before('guest');

/* User acc */
Route::get('user/images', array(
    'as' => 'images_user',
    'uses' => 'UserController@showImages'
))->before('auth');

Route::get('user/profile', array(
    'as' => 'profile_user',
    'uses' => 'UserController@showProfile'
))->before('auth');

Route::post('user/profile/edit', array(
    'uses' => 'UserController@editProfile'
))->before('auth');

Route::get('user/account', array(
    'as' => 'account_user',
    'uses' => 'UserController@showAccount'
))->before('auth');

Route::post('user/account/edit', array(
    'uses' => 'UserController@editAccount'
))->before('auth');

Route::post('user/account/delete', array(
    'uses' => 'UserController@deleteAccount'
))->before('auth');

Route::get('user/notification/latest', array(
    'as' => 'notification_user',
    'uses' => 'UserController@showNotification'
))->before('auth');

Route::post('user/notification/read', array(
    'uses' => 'VoteController@markNotification'
))->before('auth');

Route::get('user/notification/history', array(
    'as' => 'notification_history',
    'uses' => 'UserController@showNotificationHistory'
))->before('auth');

/* Voting */
Route::get('vote/{image_id}/{vote}', array(
    'uses' => 'VoteController@vote'
))->where('vote', '[0-1]');
