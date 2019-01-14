<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['query_log']], function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::group(['middleware' => ['guest']], function () {
        Route::match(['get', 'post'], 'login', ['uses' => '\App\Http\Controllers\Auth\LoginController@login', 'as' => 'login']);
        Route::post('auth/check-user', ['uses' => '\App\Http\Controllers\Auth\LoginController@checkUser', 'as' => 'check-user']);
    });


    Route::group(['middleware' => ['auth']], function () {
        Route::match(['get', 'post'], 'logout', ['uses' => '\App\Http\Controllers\Auth\LoginController@logout', 'as' => 'logout']);
        Route::get('dashboard', ['uses' => '\App\Http\Controllers\Admin\AdminController@index', 'as' => 'dashboard']);

        Route::group(['middleware' => ['role:superadmin']], function () {
            Route::get('s/roles', ['uses' => '\App\Http\Controllers\Admin\RoleController@index', 'as' => 'role.index']);
            Route::get('s/roles/default-permissions', ['uses' => '\App\Http\Controllers\Admin\RoleController@defaultPermissions', 'as' => 'role.defaultPermissions']);
            Route::post('s/roles', ['uses' => '\App\Http\Controllers\Admin\RoleController@create', 'as' => 'role.create']);
            Route::post('s/roles/assign-permissions', ['uses' => '\App\Http\Controllers\Admin\RoleController@assignPermissions', 'as' => 'role.assignPermissions']);
            Route::delete('s/roles/{id}', ['uses' => '\App\Http\Controllers\Admin\RoleController@delete', 'as' => 'role.delete']);
            Route::get('s/permissions', ['uses' => '\App\Http\Controllers\Admin\PermissionController@index', 'as' => 'permission.index']);
            Route::post('s/permissions', ['uses' => '\App\Http\Controllers\Admin\PermissionController@create', 'as' => 'permission.create']);
            Route::delete('s/permissions/{id}', ['uses' => '\App\Http\Controllers\Admin\PermissionController@delete', 'as' => 'permission.delete']);
        });
    });
});




