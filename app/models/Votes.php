<?php

class Votes extends Eloquent {
	protected $guarded = array();

    protected $table = 'votes';

	public static $rules = array();

    public function users()
    {
        return $this->belongsTo('Users', 'user_id');
    }

    public function images()
    {
        return $this->belongsTo('Images', 'image_id');
    }
}
