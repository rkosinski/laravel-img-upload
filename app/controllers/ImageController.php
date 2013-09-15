<?php

class ImageController extends BaseController {

	public function index()
	{
		return View::make('images/list')
                    ->with('title', 'List of images')
                    ->with('images', Images::orderBy('created_at', 'desc')
                                            ->where('private', 0)
                                            ->get());
	}

	public function show($id)
    {
        return View::make('images/show')
                    ->with('title', 'Your images')
                    ->with('image', Images::findOrFail($id));
    }

    public function upload()
    {
        $files = Input::file('file');
        $serializedFile = array();

        foreach ($files as $file) {
            $validator = Images::validateImage(array('file'=> $file));

            if ($validator->passes()) {
                $fileName        = $file->getClientOriginalName();
                $extension       = $file->getClientOriginalExtension();
                $folderName      = str_random(12);
                $destinationPath = 'uploads/' . $folderName;

                $file->move($destinationPath, $fileName);
                Image::make($destinationPath . '/' . $fileName)->crop(250, 250, 10, 10)->save($destinationPath . '/min_' . $fileName);
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

    public function destroy($id)
    {
        Images::find($id)->delete();

        return Redirect::route('images_user')
                        ->with('status', 'alert-success')
                        ->with('message', 'Image removed properly.');
    }

}