laravel-user
============

Fast and easy user authentication. Get up and running so you can focus on your business logic.

This is not exactly a normal package - you don't really need to install it via composer and then add a service provider.

Instead, you can just download the zip and extract the files directly into your newly-installed laravel app.

## Demo

[See demo here](http://laravel.amnahdev.com/user)

## Features

* Quick setup
* Works out of the box
* Lightweight - No library to learn. Just two controllers, models, and views
* Intended for you to dig in directly and modify the code to fit your needs
* Built-in pages
    * Registration
    * Email activation
    * Login
    * Account page (2 versions)
    * Forgot/reset password
    * Admin list user
    * Admin create user
    * Admin edit user
* Error messages on each field

## Installation

1. [Install Laravel](http://laravel.com/docs/installation) using your preferred method
2. Download the [latest version](https://github.com/amnah/laravel-user/archive/master.zip)
3. Extract *app* folder into your new Laravel installation
    * This will install a bunch of files and overwrite four files
    * **BACK UP THESE FOUR FILES IF THEY'RE IMPORTANT TO YOU**
        * *routes.php*
        * *config/auth.php*
        * *models/User.php*
        * *views/emails/auth/reminder.blade.php*
4. Set up your *app/config/database.php* and *app/config/mail.php* configs
5. Run the migration or install the .sql file directly
    * ```php artisan migrate``` or *app/database/setup_laravel_user.sql*
6. Go to your application in your browser and rejoice
    * ```http://localhost/path/to/app/public/user```

## User Permissions

This package contains a simple permissions system. Users are assigned to a role, and each role has a series of flags for their permissions denoted via columns in Role table. 

For example, let's say that you need a permission for creating posts. You would need to add a column in the Role table, e.g. *create_post*. Then, you can check the user permission using:

```
$user->perm("create_post")
```

Note: An example of this can be found in the AdminController::__construct()

Note2: There is currently no CRUD functionality for this. You will need to manually update the database or use basic Laravel query builder statements. Alternatively, you can consider using something more powerful such as [Entrust](https://github.com/zizaco/entrust).
