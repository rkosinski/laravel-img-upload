<?php

class Users extends Eloquent {
    protected $guarded = array(
        'id',
        'created_at',
        'updated_at'
    );

    protected $table = 'users';

    public static $rulesRegister = array(
        'email' => 'required|unique:users|email',
        'username' => 'min:4',
        'password' => 'required|alphanum|between:4,8|confirmed',
        'password_confirmation' => 'required'
    );

    public static $rulesLogin = array(
        'email' => 'required|email',
        'password' => 'required'
    );

    public static $rulesPasswordChange = array(
        'old_password' => 'required',
        'new_password' => 'required|alphanum|between:4,8|confirmed',
        'new_password_confirmation' => 'required'
    );

    public static function validateRegister($data)
    {
        return Validator::make($data, static::$rulesRegister);
    }

    public static function validateLogin($data)
    {
        return Validator::make($data, static::$rulesLogin);
    }

    public static function validatePublic($data)
    {
        return Validator::make($data,
            array(
                'name' => 'min:4',
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                'url' => 'url'
            )
        );
    }

    public static function validatePasswordChange($data)
    {
        return Validator::make($data, static::$rulesPasswordChange);
    }

    public static function insertUser()
    {
        return Users::insert(array(
                'email' => Input::get('email'),
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
        ));
    }

    public static function editUserProfile($user)
    {
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->url = Input::get('url');

        return $user->save();
    }

    public static function editUserPassword($user)
    {
        $user->password = Hash::make(Input::get('new_password'));

        return $user->save();
    }

    public static function deleteUserAccount($user)
    {
        return $user->delete();
    }
}