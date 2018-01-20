<?php

Route::group(['as' => 'auth::', 'namespace' => 'Auth'], function () {
    # Login
    Route::get('login', ['as' => 'login.get', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'LoginController@login']);

    # Logout
    Route::get('logout', ['as' => 'logout.get' , 'uses' => 'LoginController@logout']);

    # Password Reset
    Route::get('forgot-password', ['as' => 'forgot.password.get', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::post('forgot-password', ['as' => 'forgot.password.post', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    Route::get('reset-password/{token}', ['as' => 'reset.password.get', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('reset-password', ['as' => 'reset.password.post', 'uses' => 'ResetPasswordController@reset']);

    # Register
    Route::get('register', ['as' => 'register.get', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);
});
