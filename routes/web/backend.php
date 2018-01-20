<?php

Route::group(['as' => 'backend::', 'namespace' => 'Backend', 'middleware' => 'auth', 'prefix' => 'admin'], function(){
    Route::get('/', ['as' => 'welcome', function(){
        return redirect()->route('backend::dashboard.index');
    }]);

    Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    # ProfileController
    Route::get('profile/{id?}', ['as' => 'profile.index', 'uses' => 'ProfileController@index']);
    Route::put('profile/{id}', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

    # UserController
    Route::get('user', ['as' => 'user.index', 'middleware' => 'access:index,admin/user', 'uses' => 'UserController@index']);
    Route::get('user/datatables', ['as' => 'user.datatables', 'middleware' => 'access:index,admin/user', 'uses' => 'UserController@datatables']);
    Route::get('user/detail/{id}', ['as' => 'user.detail', 'middleware' => 'access:detail,admin/user', 'uses' => 'UserController@detail']);
    Route::get('user/create', ['as' => 'user.create', 'middleware' => 'access:create,admin/user', 'uses' => 'UserController@create']);
    Route::post('user/create', ['as' => 'user.store', 'middleware' => 'access:create,admin/user', 'uses' => 'UserController@store']);
    Route::get('user/activate/{id}', ['as' => 'user.activate.get', 'middleware' => 'access:activate,admin/user', 'uses' => 'UserController@getActivate']);
    Route::post('user/activate/{id}', ['as' => 'user.activate.post', 'middleware' => 'access:activate,admin/user', 'uses' => 'UserController@postActivate']);
    Route::get('user/deactivate/{id}', ['as' => 'user.deactivate.get', 'middleware' => 'access:deactivate,admin/user', 'uses' => 'UserController@getDeactivate']);
    Route::post('user/deactivate/{id}', ['as' => 'user.deactivate.post', 'middleware' => 'access:deactivate,admin/user', 'uses' => 'UserController@postDeactivate']);

    # RoleController
    Route::get('role', ['as' => 'role.index', 'middleware' => 'access:index,admin/role', 'uses' => 'RoleController@index']);
    Route::get('role/datatables', ['as' => 'role.datatables', 'middleware' => 'access:index,admin/role', 'uses' => 'RoleController@datatables']);
    Route::get('role/detail/{id}', ['as' => 'role.detail', 'middleware' => 'access:detail,admin/role', 'uses' => 'RoleController@detail']);
    Route::get('role/create', ['as' => 'role.create', 'middleware' => 'access:create,admin/role', 'uses' => 'RoleController@create']);
    Route::post('role/create', ['as' => 'role.store', 'middleware' => 'access:create,admin/role', 'uses' => 'RoleController@store']);
    Route::get('role/edit/{id}', ['as' => 'role.edit', 'middleware' => 'access:update,admin/role', 'uses' => 'RoleController@edit']);
    Route::put('role/edit/{id}', ['as' => 'role.update', 'middleware' => 'access:update,admin/role', 'uses' => 'RoleController@update']);
    Route::get('role/delete/{id}', ['as' => 'role.delete', 'middleware' => 'access:delete,admin/role', 'uses' => 'RoleController@delete']);
    Route::delete('role/delete/{id}', ['as' => 'role.destroy', 'middleware' => 'access:delete,admin/role', 'uses' => 'RoleController@destroy']);

    # MenuController
    Route::get('menu', ['as' => 'menu.index', 'middleware' => 'access:index,admin/menu', 'uses' => 'MenuController@index']);
    Route::get('menu/detail/{id}', ['as' => 'menu.detail', 'middleware' => 'access:detail,admin/menu', 'uses' => 'MenuController@detail']);
    Route::get('menu/create', ['as' => 'menu.create', 'middleware' => 'access:create,admin/menu', 'uses' => 'MenuController@create']);
    Route::post('menu/create', ['as' => 'menu.store', 'middleware' => 'access:create,admin/menu', 'uses' => 'MenuController@store']);
    Route::get('menu/edit/{id}', ['as' => 'menu.edit', 'middleware' => 'access:update,admin/menu', 'uses' => 'MenuController@edit']);
    Route::put('menu/edit/{id}', ['as' => 'menu.update', 'middleware' => 'access:update,admin/menu', 'uses' => 'MenuController@update']);
    Route::get('menu/delete/{id}', ['as' => 'menu.delete', 'middleware' => 'access:delete,admin/menu', 'uses' => 'MenuController@delete']);
    Route::delete('menu/delete/{id}', ['as' => 'menu.destroy', 'middleware' => 'access:delete,admin/menu', 'uses' => 'MenuController@destroy']);

    # ScoringController
    Route::get('scoring', ['as' => 'scoring.index', 'middleware' => 'access:index,admin/scoring', 'uses' => 'ScoringController@index']);
    Route::get('scoring/datatables', ['as' => 'scoring.datatables', 'middleware' => 'access:index,admin/scoring', 'uses' => 'ScoringController@datatables']);
    Route::get('scoring/detail/{id}', ['as' => 'scoring.detail', 'middleware' => 'access:detail,admin/scoring', 'uses' => 'ScoringController@detail']);
    Route::get('scoring/create', ['as' => 'scoring.create', 'middleware' => 'access:create,admin/scoring', 'uses' => 'ScoringController@create']);
    Route::post('scoring/create', ['as' => 'scoring.store', 'middleware' => 'access:create,admin/scoring', 'uses' => 'ScoringController@store']);
    Route::get('scoring/hitung', ['as' => 'scoring.hitung', 'middleware' => 'access:create,admin/scoring', 'uses' => 'ScoringController@hitung']);
    Route::get('scoring/edit/{id}', ['as' => 'scoring.edit', 'middleware' => 'access:update,admin/scoring', 'uses' => 'ScoringController@edit']);
    Route::put('scoring/edit/{id}', ['as' => 'scoring.update', 'middleware' => 'access:update,admin/scoring', 'uses' => 'ScoringController@update']);
    Route::get('scoring/delete/{id}', ['as' => 'scoring.delete', 'middleware' => 'access:delete,admin/scoring', 'uses' => 'ScoringController@delete']);
    Route::delete('scoring/delete/{id}', ['as' => 'scoring.destroy', 'middleware' => 'access:delete,admin/scoring', 'uses' => 'ScoringController@destroy']);
});
