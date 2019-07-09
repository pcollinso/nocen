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

    Route::get('test', ['uses' => '\App\Http\Controllers\PaymentController@test', 'as' => 'test']);

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::group(['middleware' => ['guest']], function () {
      Route::match(['get', 'post'], 'login', ['uses' => '\App\Http\Controllers\Auth\LoginController@login', 'as' => 'login']);
      Route::post('auth/check-user', ['uses' => '\App\Http\Controllers\Auth\LoginController@checkUser', 'as' => 'check-user']);
      Route::get('new-applicant', ['uses' => '\App\Http\Controllers\Applicant\LoginController@showRegister']);
      Route::post('new-applicant', ['uses' => '\App\Http\Controllers\Applicant\LoginController@createApplicant']);
    });


    Route::group(['middleware' => ['auth']], function () {
      Route::get('options/towns/{stateId}', ['uses' => '\App\Http\Controllers\OptionController@towns', 'as' => 'towns']);
      Route::get('options/relationships', ['uses' => '\App\Http\Controllers\OptionController@relationships', 'as' => 'relationships']);
      Route::get('options/subjects', ['uses' => '\App\Http\Controllers\OptionController@subjects', 'as' => 'subjects']);
      Route::get('options/olevel-grades', ['uses' => '\App\Http\Controllers\OptionController@olevelGrades', 'as' => 'olevelGrades']);

      Route::match(['get', 'post'], 'logout', ['uses' => '\App\Http\Controllers\Auth\LoginController@logout', 'as' => 'logout']);
      Route::get('dashboard', ['uses' => '\App\Http\Controllers\HomeController@index', 'as' => 'dashboard']);
      Route::get('action-history', ['uses' => '\App\Http\Controllers\Admin\CourseController@index', 'as' => 'action-history']);
      Route::get('change-password', ['uses' => '\App\Http\Controllers\Auth\LoginController@showChangePassword', 'as' => 'show-change-password']);
      Route::post('auth/change-password', ['uses' => '\App\Http\Controllers\Auth\LoginController@changePassword', 'as' => 'change-password']);

      Route::group(['middleware' => ['role:applicant']], function () {
        Route::get('a/home', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@index', 'as' => 'applicant.index']);
        Route::put('a/update-applicant/{id}', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@updateApplicant', 'as' => 'applicant.updateApplicant']);
        Route::post('a/next-of-kins', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@addNextOfKin', 'as' => 'applicant.addNextOfKin']);
        Route::delete('a/next-of-kins/{id}', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@removeNextOfKin', 'as' => 'applicant.removeNextOfKin']);
        Route::post('a/olevel-results', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@addOlevelResult', 'as' => 'applicant.addOlevelResult']);
        Route::delete('a/olevel-results/{id}', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@removeOlevelResult', 'as' => 'applicant.removeOlevelResult']);
        Route::post('a/utme-result', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@addUtmeResult', 'as' => 'applicant.addUtmeResult']);
        Route::post('a/{id}/confirm-application-fee', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@confirmApplicationFee', 'as' => 'applicant.confirmApplicationFee']);
        Route::delete('a/utme-result/{id}', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@removeUtmeResult', 'as' => 'applicant.removeUtmeResult']);
        Route::post('a/passport', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@uploadPassport', 'as' => 'applicant.uploadPassport']);
      });

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

          Route::get('i/setup/programmes', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@index', 'as' => 'programme.index']);
          Route::post('i/programmes', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@create', 'as' => 'programme.create']);
          Route::put('i/programmes/{id}', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@update', 'as' => 'programme.update']);
          Route::delete('i/programmes/{id}', ['uses' => '\App\Http\Controllers\Admin\ProgrammeController@delete', 'as' => 'programme.delete']);

          Route::get('i/setup/faculties', ['uses' => '\App\Http\Controllers\Admin\FacultyController@index', 'as' => 'faculty.index']);
          Route::post('i/faculties', ['uses' => '\App\Http\Controllers\Admin\FacultyController@create', 'as' => 'faculty.create']);
          Route::put('i/faculties/{id}', ['uses' => '\App\Http\Controllers\Admin\FacultyController@update', 'as' => 'faculty.update']);
          Route::delete('i/faculties/{id}', ['uses' => '\App\Http\Controllers\Admin\FacultyController@delete', 'as' => 'faculty.delete']);

          Route::get('i/setup/departments', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@index', 'as' => 'department.index']);
          Route::post('i/departments', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@create', 'as' => 'department.create']);
          Route::put('i/departments/{id}', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@update', 'as' => 'department.update']);
          Route::delete('i/departments/{id}', ['uses' => '\App\Http\Controllers\Admin\DepartmentController@delete', 'as' => 'department.delete']);

          Route::get('i/setup/fields', ['uses' => '\App\Http\Controllers\Admin\FieldController@index', 'as' => 'field.index']);
          Route::post('i/fields', ['uses' => '\App\Http\Controllers\Admin\FieldController@create', 'as' => 'field.create']);
          Route::put('i/fields/{id}', ['uses' => '\App\Http\Controllers\Admin\FieldController@update', 'as' => 'field.update']);
          Route::delete('i/fields/{id}', ['uses' => '\App\Http\Controllers\Admin\FieldController@delete', 'as' => 'field.delete']);

          Route::get('i/users', ['uses' => '\App\Http\Controllers\Admin\UserController@index', 'as' => 'user.index']);
          Route::post('i/users', ['uses' => '\App\Http\Controllers\Admin\UserController@create', 'as' => 'user.create']);
          Route::put('i/users/{id}', ['uses' => '\App\Http\Controllers\Admin\UserController@update', 'as' => 'user.update']);
          Route::delete('i/users/{id}', ['uses' => '\App\Http\Controllers\Admin\UserController@delete', 'as' => 'user.delete']);

      });

      Route::group(['middleware' => ['role:,application:review']], function () {
        Route::get('a/applications', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@listApplications', 'as' => 'applicant.listApplications']);
        Route::post('a/save-admission', ['uses' => '\App\Http\Controllers\Applicant\ApplicationController@saveAdmission', 'as' => 'applicant.saveAdmission']);
      });
    });
});
