<?php

class UserController extends BaseController {

	public function showImages()
	{
		return View::make('user/index')
                    ->with('title', 'List of images')
                    ->with('images', Images::orderBy('created_at', 'desc')
                                            ->where('user_id', Auth::user()->id)
                                            ->get());
	}

	public function login()
	{
        $inputs = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

		$validation = Users::validateLogin(Input::all());

        if (! $validation->fails()) {
            if (Auth::attempt($inputs, true)) {
                return Response::json(array('success' => true, 'redirect' => URL::to('/')));
            } else {
                return Response::json(array('success' => false, 'message' => 'Incorrect data.'));
            }
        } else {
            return Response::json(array('success' => false, 'message' => 'Incorrect data.'));
        }
	}

	public function logout()
    {
        Auth::logout();

        return Redirect::route('main')
        				->with('status', 'alert-success')
                        ->with('message', "You've been properly logged out.");
    }

    public function showRegister()
    {
    	return View::make('main/register')
                    ->with('title', 'Registration');
    }

    public function register()
    {
    	$validation = Users::validateRegister(Input::all());

        if (! $validation->fails()) {
            Users::insert(array(
                'email' => Input::get('email'),
                'name' => Input::get('name'),
                'password' => Hash::make(Input::get('password')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ));

            return Redirect::route('show_register')
                            ->with('status', 'alert-success')
                            ->with('message', "You've been correctly registered.");
        } else {
            return Redirect::route('show_register')
                            ->withErrors($validation);
        }
    }

}