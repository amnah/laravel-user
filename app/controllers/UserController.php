<?php

class UserController extends BaseController {

    /**
     * Index - profile page
     */
    public function anyIndex() {
        return $this->anyAccount();
	}

    /**
     * Register
     */
    public function anyRegister() {

        $user = new User;
        $profile = new Profile;

        // process POST
        if ($_POST) {
            // check for valid data
            // typecast to prevent error (if there are no profile fields)
            $userValidate = $user->fillValidateRegistration(Input::get("User"));
            $profileValidate = $profile->fillValidateRegistration((array)Input::get("Profile"));
            if ($userValidate and $profileValidate) {
                // register account
                $this->_register($user, $profile);

                // set success and reload page
                Session::flash("success", $user);
                return Redirect::to(Request::path());
            }
        }

        return View::make("user.register", array(
            "user"   => $user,
            "profile"=> $profile,
        ));
    }

    /**
     * Register new user
     * @param User $user
     * @param Profile $profile
     * @return bool
     */
    protected function _register($user, $profile) {

        // set up user and profile
        $roleId = Role::USER;
        $status = User::STATUS_ACTIVE;
        if (Config::get("auth.emailActivation")) {
            $status = User::STATUS_INACTIVE;
            $user->generateToken();
        }
        $user->setDefaults($roleId, $status)->save();
        $profile->setUser($user->id)->save();

        // generate activation key and send email
        if (Config::get("auth.emailActivation")) {
            // send email
            $data["user"] = $user;
            $count = Mail::send(Config::get("auth.emailViewPath").".activate", $data, function($message) use ($user, $profile) {
                $message->to($user->email, $user->username)->subject("Activate your new account");
            });
        }
        // log user in automatically
        else {
            Auth::login($user);
        }
    }

    /**
     * Logout
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout() {
        Auth::logout();
        return Redirect::to("/");
    }

    /**
     * Activate
     */
    public function anyActivate($token = "") {
        // check token
        $user = null;
        $success = false;
        if ($token and ($user = User::where("token", "=", $token)->first())) {
            // activate account
            $user->setStatus(User::STATUS_ACTIVE);
            $user->removeToken()->save();

            // set success
            $success = true;
        }

        return View::make("user.activate", array(
            "token" => $token,
            "user" => $user,
            "success" => $success,
        ));
    }

    /**
     * Login
     */
    public function anyLogin() {

        $errorLogin = null;
        $errorBanReason = null;
        $errorActivation = null;

        // process POST
        if ($_POST) {
            // get credentials
            $credentials = array(
                "email" => Input::get("email"),
                "password" => Input::get("password"),
            );

            // check for invalid login
            if (!Auth::attempt($credentials, Input::get("rememberMe"))) {
                $errorLogin = true;
            }
            // check ban status
            elseif ($user = Auth::user() and $user->banned_at) {
                $errorBanReason = $user->ban_reason;
                Auth::logout();
            }
            // check activation status
            elseif ($user->status == User::STATUS_INACTIVE) {
                $errorActivation = true;
                Auth::logout();
            }

            // handle successful login
            if (!$errorLogin and !$errorBanReason and !$errorActivation) {
                $returnUrl = Session::get("returnUrl");
                Session::forget("returnUrl");
                return Redirect::to($returnUrl ? $returnUrl : "/");
            }
        }

        return View::make("user.login", array(
            "errorLogin" => $errorLogin,
            "errorBanReason" => $errorBanReason,
            "errorActivation" => $errorActivation,
        ));
    }

    /**
     * Account
     */
    public function anyAccount() {
        // check for login
        if (!$user = Auth::user()) {
            Session::set("returnUrl", Request::path());
            return Redirect::to("user/login");
        }
        $profile = $user->profile;

        // process POST
        $errorOldPassword = null;
        if ($_POST) {
            // check oldPassword
            if (!Hash::check(Input::get("User.oldPassword"), $user->password)) {
                $errorOldPassword = true;
            }

            // fill and validate
            $userValidate = $user->fillValidateAccount(Input::get("User"));
            $profileValidate = $profile->fillValidateAccount(Input::get("Profile"));

            // check for success
            if (!$errorOldPassword and $userValidate and $profileValidate) {
                $user->save();
                $profile->save();

                // set success and reload page
                Session::flash("success", true);
                return Redirect::to(Request::path());
            }
        }

        // render view
        return View::make("user.account", array(
            "user" => $user,
            "profile" => $profile,
            "errorOldPassword" => $errorOldPassword,
        ));
    }

    /**
     * Account
     */
    public function anyAccount2() {
        // check for login
        if (!$user = Auth::user()) {
            Session::set("returnUrl", Request::path());
            return Redirect::to("user/login");
        }
        $profile = $user->profile;

        // process POST for User
        $errorOldPassword = null;
        if (isset($_POST["User"])) {
            // check oldPassword
            if (!Hash::check(Input::get("User.oldPassword"), $user->password)) {
                $errorOldPassword = true;
            }

            // fill and validate
            $userValidate = $user->fillValidateAccount(Input::get("User"));

            // check for success
            if (!$errorOldPassword and $userValidate) {
                $user->save();

                // set success and reload page
                Session::flash("success", "Account updated");
                return Redirect::to(Request::path());
            }
        }
        // process POST for profile
        elseif (isset($_POST["Profile"])) {
            // fill, validate, and check for success
            if ($profile->fillValidateAccount(Input::get("Profile"))) {
                $profile->save();

                // set success and reload page
                Session::flash("success", "Profile updated");
                return Redirect::to(Request::path());
            }
        }

        // render view
        return View::make("user.account2", array(
            "user" => $user,
            "profile" => $profile,
            "errorOldPassword" => $errorOldPassword,
        ));
    }

    /**
     * Forgot password
     */
    public function anyForgot() {

        $errorEmail = null;

        // process POST
        if ($_POST) {
            // attempt to find user
            if (!$user = User::where("email", "=", trim(Input::get("email")))->first()) {
                $errorEmail = true;
            }
            else {
                // generate token for user
                $user->generateToken()->save();

                // send email
                $data["user"] = $user;
                $count = Mail::send(Config::get("auth.reminder.email"), $data, function($message) use ($user) {
                    $message->to($user->email, $user->username)->subject("Password Reset");
                });

                // set success and reload page
                Session::flash("success", true);
                return Redirect::to(Request::path());
            }
        }

        return View::make("user.forgot", array(
            "errorEmail" => $errorEmail,
        ));
    }

    /**
     * Reset
     */
    public function anyReset($token = "") {

        $user = null;
        $errorToken = null;
        $errorEmail = null;

        // check token
        if (!$token or (!$user = User::where("token", "=", $token)->first())) {
            $errorToken = true;
        }

        // process POST
        if ($_POST) {
            // check if email matches for token
            if ($user->email != trim(Input::get("email"))) {
                $errorEmail = true;
            }

            // fill password attributes and validate
            $validateReset = $user->fillValidateReset(Input::all());

            // check for success
            $success = false;
            if (!$errorToken and !$errorEmail and $validateReset) {
                // update user
                $user->setStatus(User::STATUS_ACTIVE); // just in case
                $user->removeToken()->save();

                // set success and reload page
                Session::flash("success", true);
                return Redirect::to(Request::path());
            }
        }

        return View::make("user.reset", array(
            "token" => $token,
            "user" => $user,
            "errorToken" => $errorToken,
            "errorEmail" => $errorEmail,
        ));
    }
}