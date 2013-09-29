<?php

class VoteController extends BaseController {

    /**
     * Voting on current image with Ajax.
     *
     * @param  string $imageId
     * @param  int $voteChoice
     * @return json Response json with success - true or false, and message.
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

    /**
     * Mark notification as read.
     *
     * @return object Redirect
     */
    public function markNotification()
    {
        if (Input::get('user_id') === Auth::user()->id) {
            Votes::editNotification(Votes::find(Input::get('id')));

            return Redirect::route('notification_user')
                        ->with('status', 'alert-success')
                        ->with('message', 'Success! Marked notification as read.');
        } else {
            return Redirect::route('notification_user')
                            ->withErrors(array('error' => 'Error! Cannot mark notification as read.'));
        }
    }
}
