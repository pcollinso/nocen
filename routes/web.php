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

            Route::get('i/course-prerequisites', ['uses' => '\App\Http\Controllers\Admin\CoursePrerequisiteController@index', 'as' => 'course_prerequisite.index']);
            Route::post('i/course-prerequisites', ['uses' => '\App\Http\Controllers\Admin\CoursePrerequisiteController@create', 'as' => 'course_prerequisite.create']);
            Route::put('i/course-prerequisites/{id}', ['uses' => '\App\Http\Controllers\Admin\CoursePrerequisiteController@update', 'as' => 'course_prerequisite.update']);
            Route::delete('i/course-prerequisites/{id}', ['uses' => '\App\Http\Controllers\Admin\CoursePrerequisiteController@delete', 'as' => 'course_prerequisite.delete']);

            Route::get('i/setup/programme', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@index', 'as' => 'programme.index']);
            Route::get('i/setup/faculty', ['uses' => '\App\Http\Controllers\Admin\FacultyController@index', 'as' => 'faculty.index']);
            Route::get('i/setup/department', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@index', 'as' => 'department.index']);
            Route::get('i/setup/field', ['uses' => '\App\Http\Controllers\Admin\FieldController@index', 'as' => 'field.index']);
            Route::get('i/setup/course', ['uses' => '\App\Http\Controllers\Admin\CourseController@index', 'as' => 'course.index']);

            Route::post('i/setup/programme', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@create', 'as' => 'programme.create']);
            Route::post('i/setup/faculty', ['uses' => '\App\Http\Controllers\Admin\FacultyController@create', 'as' => 'faculty.create']);
            Route::post('i/setup/department', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@create', 'as' => 'department.create']);
            Route::post('i/setup/field', ['uses' => '\App\Http\Controllers\Admin\FieldController@create', 'as' => 'field.create']);
            Route::post('i/setup/course', ['uses' => '\App\Http\Controllers\Admin\CourseController@create', 'as' => 'course.create']);

            Route::put('i/setup/programme/{id}', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@update', 'as' => 'programme.update']);
            Route::put('i/setup/faculty/{id}', ['uses' => '\App\Http\Controllers\Admin\FacultyController@update', 'as' => 'faculty.update']);
            Route::put('i/setup/department/{id}', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@update', 'as' => 'department.update']);
            Route::put('i/setup/field/{id}', ['uses' => '\App\Http\Controllers\Admin\FieldController@update', 'as' => 'field.update']);
            Route::put('i/setup/course/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseController@update', 'as' => 'course.update']);

            Route::delete('i/setup/programme/{id}', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@delete', 'as' => 'programme.delete']);
            Route::delete('i/setup/faculty/{id}', ['uses' => '\App\Http\Controllers\Admin\FacultyController@delete', 'as' => 'faculty.delete']);
            Route::delete('i/setup/department/{id}', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@delete', 'as' => 'department.delete']);
            Route::delete('i/setup/field/{id}', ['uses' => '\App\Http\Controllers\Admin\FieldController@delete', 'as' => 'field.delete']);
            Route::delete('i/setup/course/{id}', ['uses' => '\App\Http\Controllers\Admin\CourseController@delete', 'as' => 'course.delete']);

            Route::post('i/users', ['uses' => '\App\Http\Controllers\Admin\UserController@create', 'as' => 'user.create']);
            Route::get('i/users', ['uses' => '\App\Http\Controllers\Admin\UserController@index', 'as' => 'user.index']);
            Route::put('i/users/{id}', ['uses' => '\App\Http\Controllers\Admin\UserController@update', 'as' => 'user.update']);
            Route::delete('i/users/{id}', ['uses' => '\App\Http\Controllers\Admin\UserController@delete', 'as' => 'user.delete']);

        });
    });
});




