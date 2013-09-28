<?php

class VoteController extends BaseController {

    public function vote($imageId, $voteChoice)
    {
        if (Auth::guest()) {
            return Response::json(array('success' => false, 'message' => 'You must be logged in to vote!'));

        } else {
            $vote = Votes::where('image_id', $imageId)->where('user_id', Auth::user()->id)->count();

            if ($vote !== '0') {
                return Response::json(array('success' => false, 'message' => 'You already voted!'));

            } else {
                Votes::insertVote($imageId, $voteChoice);

                return Response::json(array('success' => true, 'message' => 'Thank you for voting!'));
            }
        }
    }
}
