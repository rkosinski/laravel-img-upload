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

    public static function insertVote($imageId, $voteChoice)
    {
        return Votes::insert(array(
                'user_id' => Auth::user()->id,
                'image_id' => $imageId,
                'vote' => $voteChoice,
                'notification' => 1
        ));
    }
}
