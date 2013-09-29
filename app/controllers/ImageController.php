<?php

class ImageController extends BaseController {

    /**
     * Showing list of public images (marked as 0 in private table).
     * Pagination by 42 items per page (infinite scrolling).
     *
     * @return object View
     */
    public function index()
    {
        return View::make('images/list')
                    ->with('title', 'List of images')
                    ->with('images', Images::orderBy('created_at', 'desc')
                                            ->where('private', 0)
                                            ->paginate('42'));
    }

    /**
     * Show image by id. Show good votes and bad votes (with percent bar).
     * Additional information about image - showing user.
     *
     * @param  int $id
     * @return object View
     */
    public function show($id)
    {
        // Showing goodvotes and badvotes
        $goodVotes = $this->vote($id, 1);
        $badVotes = $this->vote($id, 0);

        // If image doesn't have votes, set 100% to good votes percent
        // Else calculate percent of good votes
        // And substract good votes percent from 100%
        if ($goodVotes == false && $badVotes == false) {
            $goodVotesPercent = 100;
            $badVotesPercent = 0;
        } else {
            $goodVotesPercent = ($goodVotes / ($goodVotes + $badVotes)) * 100;
            $badVotesPercent = 100 - $goodVotesPercent;
        }

        return View::make('images/show')
                    ->with('title', 'Your images')
                    ->with('image', Images::findOrFail($id))
                    ->with('user_image', $this->showUser($id))
                    ->with('votes', array(
                        'auth' => $this->checkAuth($id),
                        'good_votes' => $goodVotes,
                        'bad_votes' => $badVotes,
                        'good_percent' => $goodVotesPercent,
                        'bad_percent' => $badVotesPercent
                    ));
    }

    /**
     * Counting current image votes.
     *
     * @param  int $id
     * @param  bool $type
     * @return int | bool
     */
    private function vote($id, $type)
    {
        $votes = Votes::where('image_id', $id)->where('vote', $type)->count();
        if ($votes !== 0) {
            return $votes;
        } else {
            return false;
        }
    }

    /**
     * Showing author of current image.
     *
     * @param  int $id
     * @return string
     */
    private function showUser($id)
    {
        $image = Images::findOrFail($id);

        // If current user is not anonymous (id of 0, or deleted user)
        // Show author username
        // Else return anonymous
        if (! ($image->user_id == 0 || empty($image->users->name))) {
            return $image->users->name;
        } else {
            return 'anonymous';
        }
    }

    /**
     * Checking user authentication.
     *
     * @param  int $id
     * @return int | bool
     */
    private function checkAuth($id)
    {
        if (! Auth::guest()) {
            return Votes::where('image_id', $id)->where('user_id', Auth::user()->id)->count();
        } else {
            return false;
        }
    }

    /**
     * Uploading multiple images method.
     *
     * @return object Redirect
     */
    public function upload()
    {
        $files = Input::file('file');
        $serializedFile = array();

        foreach ($files as $file) {
            // Validate files from input file
            $validation = Images::validateImage(array('file'=> $file));

            if (! $validation->fails()) {

                // If validation pass, get filename and extension
                // Generate random (12 characters) string
                // And specify a folder name of uploaded image
                $fileName        = $file->getClientOriginalName();
                $extension       = $file->getClientOriginalExtension();
                $folderName      = str_random(12);
                $destinationPath = 'uploads/' . $folderName;

                // Move file to generated folder
                $file->move($destinationPath, $fileName);

                // Crop image (possible by Intervention Image Class)
                // And save as miniature
                Image::make($destinationPath . '/' . $fileName)->crop(250, 250, 10, 10)->save($destinationPath . '/min_' . $fileName);

                // Insert image information to database
                Images::insertImage($folderName, $fileName);
            } else {
                return Redirect::route('main')
                        ->with('status', 'alert-danger')
                        ->with('image-message', 'There is a problem uploading your image!');
            }

            $serializedFile[] = $folderName;
        }

        return Redirect::route('main')
                        ->with('status', 'alert-success')
                        ->with('files', $serializedFile)
                        ->with('image-message', 'Congratulations! Your photo(s) has been added');
    }

    /**
     * Delete specified image from database.
     *
     * @param  int $id
     * @return object Redirect
     */
    public function destroy($id)
    {
        Images::find($id)->delete();

        return Redirect::route('images_user')
                        ->with('status', 'alert-success')
                        ->with('message', 'Image removed properly.');
    }

}