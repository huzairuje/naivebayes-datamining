<?php

Route::group(['as' => 'frontend::', 'namespace' => 'Frontend'], function(){
    Route::get('home', ['as' => 'home.index', 'uses' => 'HomeController@index']);
});
