<?php

class VoteController extends BaseController {

	public function vote($image_id, $vote)
	{
		Votes::insert(array(
			'user_id' => Auth::user()->id,
			'image_id' => $image_id,
			'vote' => $vote
		));
	}

}
