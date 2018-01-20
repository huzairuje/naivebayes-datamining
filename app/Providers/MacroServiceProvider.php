<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->formMacro();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function formMacro()
    {
        \Form::macro('viewStatic', function($value){
            return '<div class="form-control-static">'.$value.'</div>';
        });

        \Form::macro('viewText', function($value){
            return '<input type="text" class="form-control" value="'.$value.'" readonly>';
        });

        \Form::macro('viewTextarea', function($value){
            return '<textarea class="form-control" readonly rows="4">'.$value.'</textarea>';
        });
    }
}
