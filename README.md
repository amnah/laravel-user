laravel-user
============

Fast and easy user authentication. Get up and running so you can focus on your business logic. 

This is not exactly a normal package - you don't really need to install it via composer and then add a service provider. 

Instead, you can just download the zip and extract the files directly into your newly-installed laravel app.

## Features

* Quick setup
* Works out of the box
* Lightweight - No library to learn. Just a controller, models, and views
* Intended for you to dig in directly and modify the code to fit your needs
* Built-in pages
    * Registration 
    * Email activation
    * Login
    * Account page (2 versions)
    * Forgot/reset password
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
    
