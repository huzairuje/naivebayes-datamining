<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'welcome', function () {
    if (Auth::guest()) {
        return redirect()->route('frontend::home.index');
    } else {
        return redirect()->route('backend::dashboard.index');
    }
}]);

# Routes Web Auth
include('web/auth.php');

# Routes Web Frontend
include('web/frontend.php');

# Routes Web Backend
include('web/backend.php');
