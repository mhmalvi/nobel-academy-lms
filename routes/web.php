<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/', 'AppController@index')->name('index');

    Route::get('/dashboard', 'AppController@index')->name('dashboard');


    /**
     * Student's Panel
     */
    Route::prefix('student')->group(function () {
        Route::get('{id}/course', 'StudentCourseController@index')->name('course');
        Route::get('{unique_id}/unit', 'StudentCourseController@courseUnit')->name('unit');
        Route::get('{unitId}/step/{stepId}', 'StudentCourseController@getStep')->name('step');
        Route::post('{unitId}/complete-step/{id}', 'StudentCourseController@completeStep')->name('complete.step');
        // Route::post('{unitId}/assesment/{stepId}', 'StudentCourseController@assesment')->name('student.asses');
    });



    /**
     * Teacher's Panel
     */
    Route::prefix('instructor')->group(function () {
        Route::get('{id}', 'TeacherCourseController@index')->name('teacher.course');
        Route::get('{id}/unit', 'TeacherCourseController@courseUnit')->name('teacher.unit');
    });

    Route::get('share/resources', 'FileController@index')->name('share.resource');
    Route::post('share/resources', 'FileController@store');

    Route::get('download/{file}', 'FileController@fileDownload')->name('download.unitFile');

    Route::get('calendar', 'CalendarController@index')->name('calendar');

    Route::get('edit-profile', 'AppController@userProfile')->name('edit.profile');
    Route::post('edit-profile', 'AppController@updateProfileInfo');

    Route::get('announcements/{id}', 'AppController@notice')->name('notice');
});

require __DIR__ . '/auth.php';
