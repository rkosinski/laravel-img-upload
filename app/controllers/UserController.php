<?php

class UserController extends BaseController {

    /**
     * Showing list of users images
     *
     * @return object View
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
     * @return object Redirect to main with success message
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
     * @return object View with register form
     */
    public function showRegister()
    {
        return View::make('main/register')
                    ->with('title', 'Registration');
    }

    /**
     * Register new user. Validating inputs etc.
     *
     * @return object Redirect with message (success or validation errors)
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
     * @return object View
     */
    public function showProfile()
    {
        return View::make('user/settings/profile')
                    ->with('title', 'Your profile');
    }

    /**
     * Edit profile data. Validate inputs etc.
     *
     * @return object Redirect with message (success or validation errors)
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
     * @return object View
     */
    public function showAccount()
    {
        return View::make('user/settings/account')
                    ->with('title', 'Account settings');
    }

    /**
     * Edit current user password. Validating inputs. Checking current password etc.
     *
     * @return object Redirect with message (success or validation errors)
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
     * @return object Redirect with message (success or validation errors)
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
     * Notification query.
     *
     * @param  int $type
     * @return mixed
     */
    private function notification($type)
    {
        return Votes::where('user_id', '<>', Auth::user()->id)
                                                ->where('notification', $type)
                                                ->get();
    }

    /**
     * Show latest notifications table.
     * Contains all of the unmarked votes commited on current user images.
     *
     * @return object View
     */
    public function showNotification()
    {
        return View::make('user/settings/notification')
                    ->with('title', 'Latest notifications')
                    ->with('notifications', $this->notification(1));
    }

    /**
     * Show latest notifications table.
     * Contains all of the marked votes commited on current user images.
     *
     * @return object View
     */
    public function showNotificationHistory()
    {
        return View::make('user/settings/notification_history')
                    ->with('title', 'Notification history')
                    ->with('notifications', $this->notification(0));
    }

}