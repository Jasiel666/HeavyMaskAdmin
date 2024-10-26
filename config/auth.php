<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Authentication Defaults
    |---------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |---------------------------------------------------------------------------
    | Authentication Guards
    |---------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | A great default configuration has been defined for you.
    |
    */

   'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    ],

    /*
    |---------------------------------------------------------------------------
    | User Providers
    |---------------------------------------------------------------------------
    |
    | All authentication guards have a user provider, which defines how the
    | users are actually retrieved out of your database or other storage
    | system used by the application. Typically, Eloquent is utilized.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        'admins' => [ // New provider for Admins
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    /*
    |---------------------------------------------------------------------------
    | Resetting Passwords
    |---------------------------------------------------------------------------
    |
    | These configuration options specify the behavior of Laravel's password
    | reset functionality.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [ // New settings for Admins
            'provider' => 'admins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |---------------------------------------------------------------------------
    | Password Confirmation Timeout
    |---------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
