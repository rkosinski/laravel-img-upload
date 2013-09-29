<?php

class UserController extends BaseController {

    /**
     * Showing list of users images
     *
     * @return array View
     */
    public function showImages()
    {
        return View::make('user/index')
                    ->with('title', 'List of images')
                    ->with('images', Images::orderBy('created_at', 'desc')
                    ->where('user_id', Auth::user()->id)
                                            ->get());
    }

    /**
     * Login user method. Checking validation, inputs etc.
     *
     * @return json Response array with messages, and success information
     */
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

    /**
     * Logout current auth user.
     *
     * @return array Redirect to main with success message
     */
    public function logout()
    {
        Auth::logout();

        return Redirect::route('main')
                        ->with('status', 'alert-success')
                        ->with('message', 'You have been properly logged out.');
    }

    /**
     * Showing registration form.
     *
     * @return array View with register form
     */
    public function showRegister()
    {
        return View::make('main/register')
                    ->with('title', 'Registration');
    }

    /**
     * Register new user. Validating inputs etc.
     *
     * @return array Redirect with message (success or validation errors)
     */
    public function register()
    {
        $validation = Users::validateRegister(Input::all());

        if (! $validation->fails()) {
            Users::insertUser();

            return Redirect::route('show_register')
                            ->with('status', 'alert-success')
                            ->with('message', 'You have been correctly registered.');
        } else {
            return Redirect::route('show_register')
                            ->withErrors($validation);
        }
    }

    /**
     * Showing form with auth profile data.
     *
     * @return array View
     */
    public function showProfile()
    {
        return View::make('user/settings/profile')
                    ->with('title', 'Your profile');
    }

    /**
     * Edit profile data. Validate inputs etc.
     *
     * @return array Redirect with message (success or validation errors)
     */
    public function editProfile()
    {
        $validation = Users::validatePublic(Input::all());

        if (! $validation->fails()) {
            Users::editUserProfile(Users::find(Auth::user()->id));

            return Redirect::route('profile_user')
                            ->with('status', 'alert-success')
                            ->with('message', 'Your public data has been correctly edited.');
        } else {
            return Redirect::route('profile_user')
                            ->withErrors($validation);
        }
    }

    /**
     * Show account form data. Change password form, and delete account.
     *
     * @return array View
     */
    public function showAccount()
    {
        return View::make('user/settings/account')
                    ->with('title', 'Account settings');
    }

    /**
     * Edit current user password. Validating inputs. Checking current password etc.
     *
     * @return array Redirect with message (success or validation errors)
     */
    public function editAccount()
    {
        $validation = Users::validatePasswordChange(Input::all());

        $inputs = array(
            'email' => Auth::user()->email,
            'password' => Input::get('old_password')
        );

        if (Auth::attempt($inputs)) {
            if (! $validation->fails()) {
                Users::editUserPassword(Users::find(Auth::user()->id));

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

    /**
     * Deleting current user account.
     *
     * @return array Redirect with message (success or validation errors)
     */
    public function deleteAccount()
    {
        $inputs = array(
            'email' => Auth::user()->email,
            'password' => Input::get('password')
        );

        if (Auth::attempt($inputs)) {
            Users::deleteUserAccount(Users::find(Auth::user()->id));

            return Redirect::route('main')
                            ->with('status', 'alert-success')
                            ->with('message', 'Your account has been properly deleted.');
        } else {
            return Redirect::route('account_user')
                            ->withErrors(array('error' => 'Wrong password!'));
        }
    }

    /**
     * Show notification history table.
     * Contains all of the votes commited on current user images.
     *
     * @return array View
     */
    public function showNotification()
    {
        return View::make('user/settings/notification')
                    ->with('notifications', Votes::where('user_id', '<>', Auth::user()->id)->get())
                    ->with('title', 'Notification history');
    }

}