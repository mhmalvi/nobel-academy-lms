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
    Route::view('edit-profile', 'pages.profile')->name('edit.profile');
    Route::put('edit-basic-info', 'ProfileController@updateBasicInfo');
    Route::post('edit-profile-picture', 'ProfileController@updateProfilePicture');


    Route::get('meetings', 'ZoomAppController@index')->name('meeting');
    Route::get('meeting-list-by-host', 'ZoomAppController@getList');
    Route::post('create/meeting', 'ZoomAppController@createMeeting')->name('create.meeting');
    Route::post('remove/meeting/{id}', 'ZoomAppController@destroy')->name('remove.meeting');

    /**
     * Course
     */
    Route::prefix('course')->group(function () {
        Route::get('{course}', 'CourseController@show')->name('courses');
    });


    /**
     * Student's Panel
     */
    Route::prefix('student')->group(function () {
        Route::get('{id}/course', 'StudentCourseController@index')->name('course');
        Route::get('{unique_id}/unit', 'StudentCourseController@courseUnit')->name('unit');
        Route::get('{unitId}/step/{stepId}', 'StudentCourseController@getStep')->name('step');
        Route::post('{unitId}/complete-step/{id}', 'StudentCourseController@completeStep')->name('complete.step');
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

    Route::get('download/{directory}/{file}', 'FileController@fileDownload')->name('download.file');

    Route::get('announcements/{id}', 'AppController@notice')->name('notice');

    Route::prefix('classroom')->group(function () {
        Route::view('/', 'pages.allClassRooms')->name('classrooms');
        Route::get('{uuid}', 'ClassroomsController@classroom')->name('class');
        Route::get('{uuid}/{type}', 'PostsController@index')->name('post.type');
        Route::post('{uuid}/post', 'PostsController@store')->name('post');
    });
    Route::get('post/{uuid}', 'PostsController@destroy')->name('delete.post');
});

require __DIR__ . '/auth.php';
