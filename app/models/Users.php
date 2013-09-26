<?php

class Users extends Eloquent {
    protected $guarded = array();

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
}