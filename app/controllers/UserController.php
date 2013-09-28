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
            Users::insertUser();

            return Redirect::route('show_register')
                            ->with('status', 'alert-success')
                            ->with('message', "You've been correctly registered.");
        } else {
            return Redirect::route('show_register')
                            ->withErrors($validation);
        }
    }

    public function showProfile()
    {
        return View::make('user/settings/profile')
                    ->with('title', 'Your profile');
    }

    public function editProfile()
    {
        $validation = Users::validatePublic(Input::all());

        if (! $validation->fails()) {
            $user = Users::find(Auth::user()->id);

            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->url = Input::get('url');

            $user->save();

            return Redirect::route('profile_user')
                            ->with('status', 'alert-success')
                            ->with('message', 'Your public data has been correctly edited.');
        } else {
            return Redirect::route('profile_user')
                            ->withErrors($validation);
        }
    }

    public function showAccount()
    {
        return View::make('user/settings/account')
                    ->with('title', 'Account settings');
    }

    public function editAccount()
    {
        $validation = Users::validatePasswordChange(Input::all());

        $inputs = array(
            'email' => Auth::user()->email,
            'password' => Input::get('old_password')
        );

        if (Auth::attempt($inputs)) {
            if (! $validation->fails()) {
                $user = Users::find(Auth::user()->id);

                $user->password = Hash::make(Input::get('new_password'));

                $user->save();

                return Redirect::route('account_user')
                            ->with('status', 'alert-success')
                            ->with('message', 'Your account password has been correctly edited.');
            } else {
                return Redirect::route('account_user')
                                ->withErrors($validation);
            }
        } else {
            return Redirect::route('account_user')
                            ->withErrors(array('error' => 'Wrong current password!'));
        }
    }

    public function showNotification()
    {
        return View::make('user/settings/notification')
                    ->with('notifications', Votes::where('user_id', '<>', Auth::user()->id)->get())
                    ->with('title', 'Notification history');
    }

    public function deleteAccount()
    {
        $inputs = array(
            'email' => Auth::user()->email,
            'password' => Input::get('password')
        );

        if (Auth::attempt($inputs)) {
            $user = User::find(Auth::user()->id);
            $user->delete();

            return Redirect::route('main')
                            ->with('status', 'alert-success')
                            ->with('message', 'Your account has been properly deleted.');
        } else {
            return Redirect::route('account_user')
                            ->withErrors(array('error' => 'Wrong password!'));
        }
    }

}