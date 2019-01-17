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

            Route::get('s/institutions', ['uses' => '\App\Http\Controllers\Admin\InstitutionController@index', 'as' => 'institution.index']);
            Route::post('s/institutions', ['uses' => '\App\Http\Controllers\Admin\InstitutionController@create', 'as' => 'institution.create']);
            Route::put('s/institutions/{id}', ['uses' => '\App\Http\Controllers\Admin\InstitutionController@update', 'as' => 'institution.update']);

            Route::get('s/institution-admins', ['uses' => '\App\Http\Controllers\Admin\InstitutionAdminController@index', 'as' => 'institution_admin.index']);
            Route::post('s/institution-admins', ['uses' => '\App\Http\Controllers\Admin\InstitutionAdminController@create', 'as' => 'institution_admin.create']);
            Route::put('s/institution-admins/{id}', ['uses' => '\App\Http\Controllers\Admin\InstitutionAdminController@update', 'as' => 'institution_admin.update']);
        });

        Route::group(['middleware' => ['role:institutionadmin']], function () {
            Route::get('i/courses', ['uses' => '\App\Http\Controllers\Admin\CourseController@index', 'as' => 'course.index']);
            Route::post('i/courses', ['uses' => '\App\Http\Controllers\Admin\CourseController@create', 'as' => 'course.create']);
            Route::put('i/courses/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseController@update', 'as' => 'course.update']);
            Route::delete('i/courses/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseController@delete', 'as' => 'course.delete']);

            Route::get('i/course-coordinators', ['uses' => '\App\Http\Controllers\Admin\CourseCoordinatorController@index', 'as' => 'course_coordinator.index']);
            Route::post('i/course-coordinators', ['uses' => '\App\Http\Controllers\Admin\CourseCoordinatorController@create', 'as' => 'course_coordinator.create']);
            Route::put('i/course-coordinators/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseCoordinatorController@update', 'as' => 'course_coordinator.update']);
            Route::delete('i/course-coordinators/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseCoordinatorController@delete', 'as' => 'course_coordinator.delete']);

            Route::get('i/course-advisers', ['uses' => '\App\Http\Controllers\Admin\CourseAdviserController@index', 'as' => 'course_adviser.index']);
            Route::post('i/course-advisers', ['uses' => '\App\Http\Controllers\Admin\CourseAdviserController@create', 'as' => 'course_adviser.create']);
            Route::put('i/course-advisers/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseAdviserController@update', 'as' => 'course_adviser.update']);
            Route::delete('i/course-advisers/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseAdviserController@delete', 'as' => 'course_adviser.delete']);
        });
    });
});




