<?php

class Images extends Eloquent {
    protected $guarded = array();

    protected $table = 'images';

    public static $rules = array(
        'file' => 'mimes:jpeg,bmp,png|max:3000'
    );

    public static function validateImage($data)
    {
        return Validator::make($data, static::$rules);
    }

    public static function insertImage($folderName, $fileName)
    {
        return Images::insert(array(
                    'id'         => $folderName,
                    'user_id'    => Auth::check() ? Auth::user()->id : 0,
                    'img_big'    => $fileName,
                    'img_min'    => 'min_' . $fileName,
                    'ip'         => Request::getClientIp(),
                    'private'    => Input::get('private') ? 1 : 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
        ));
    }

    public function users()
    {
        return $this->belongsTo('Users', 'user_id');
    }

    public function votes()
    {
        return $this->hasMany('Votes');
    }
}