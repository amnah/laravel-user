laravel-user
============

Fast and simple user authentication

## Features
* Simple code with no convoluted libraries. Just a controller, models, and views
* Built-in functionality
    * Registration 
    * Email activation
    * Login
    * Account page (2 versions)
    * Forgot/reset password
* **NO ADMIN FUNCTIONALITY YET**

## Installation

1. [Install Laravel](http://laravel.com/docs/installation) using your preferred method
2. Download the [latest version](https://github.com/amnah/laravel-user/archive/master.zip)
3. Extract *app* folder into your new Laravel installation. This will install a bunch of files and overwrite 4 files
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