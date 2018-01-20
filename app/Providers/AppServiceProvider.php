<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->validation();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function validation()
    {
        \Validator::extend('password_old', function($attribute, $value, $parameters, $validator) {
            return check_password($value, $parameters[0]);
        });
    }
}
