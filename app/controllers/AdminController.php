<?php

class AdminController extends BaseController {

    /**
     * Constuct
     */
    public function __construct() {

        // remove this to enable permissions
        return false;

        // check for login
        if (!$user = Auth::user()) {
            Session::set("returnUrl", Request::path());
            return Redirect::to("user/login");
        }
        elseif (!$user->perm("admin")) {
            throw new Exception("arrrrrr matey no admin permissions");
        }
    }

    /**
     * Index
     */
    public function anyIndex() {
        return $this->anyList();
	}

    /**
     * List
     */
    public function anyList() {
        $users = User::withTrashed()->get();
        return View::make("admin.list", array(
            "users"   => $users,
        ));
    }

    /**
     * Create
     */
    public function anyCreate() {

        $user = new User;
        $profile = new Profile;

        // process POST
        if ($_POST) {
            // check for valid data
            // typecast to prevent error (if there are no profile fields)
            $userValidate = $user->fillValidateAdminCreate(Input::get("User"));
            $profileValidate = $profile->fillValidateAdminCreate((array)Input::get("Profile"));
            if ($userValidate and $profileValidate) {
                $user->save();
                $profile->setUser($user->id)->save();

                // set success and reload page
                Session::flash("success", $user);
                return Redirect::to(Request::path());
            }
        }

        return View::make("admin.create", array(
            "user"   => $user,
            "profile"=> $profile,
        ));
    }

    /**
     * Edit
     */
    public function anyEdit($userId) {

        $user = User::find($userId);
        $profile = $user->profile;

        // process POST
        if ($_POST) {
            // check for valid data
            // typecast to prevent error (if there are no profile fields)
            $userValidate = $user->fillValidateAdminEdit(Input::get("User"));
            $profileValidate = $profile->fillValidateAdminEdit((array)Input::get("Profile"));
            if ($userValidate and $profileValidate) {
                $user->save();
                $profile->save();

                // set success and reload page
                Session::flash("success", $user);
                return Redirect::to(Request::path());
            }
        }

        return View::make("admin.edit", array(
            "user"   => $user,
            "profile"=> $profile,
        ));
    }

    /**
     * Delete
     */
    public function postDelete() {
        // check for valid user
        $userId = Input::get("userId");
        if (!$user = User::find($userId)) {
            throw new Exception("Invalid user to delete");
        }

        // delete and redirect back to list
        $user->delete();
        Session::flash("delete-success", $user);
        return Redirect::to("admin/list");
    }

    /**
     * Restore
     */
    public function postRestore() {
        // check for valid user
        $userId = Input::get("userId");
        if (!$user = User::withTrashed()->find($userId)) {
            throw new Exception("Invalid user to restore");
        }

        // restore and redirect back to list
        $user->restore();
        Session::flash("restore-success", $user);
        return Redirect::to("admin/list");
    }
}