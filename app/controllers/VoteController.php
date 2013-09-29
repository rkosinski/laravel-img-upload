<?php

class VoteController extends BaseController {

    /**
     * Voting on current image with Ajax.
     *
     * @param  string $imageId   Id of current image
     * @param  int $voteChoice   Good - 1, or Bad - 0
     * @return array             Response json with success - true or false, and message.
     */
    public function vote($imageId, $voteChoice)
    {
        if (Auth::guest()) {
            return Response::json(array('success' => false, 'message' => 'You must be logged in to vote!'));

        } else {
            $vote = Votes::where('image_id', $imageId)->where('user_id', Auth::user()->id)->count();

            if ((int) $vote !== 0) {
                return Response::json(array('success' => false, 'message' => 'You already voted!'));

            } else {
                Votes::insertVote($imageId, $voteChoice);

                return Response::json(array('success' => true, 'message' => 'Thank you for voting!'));
            }
        }
    }
}
