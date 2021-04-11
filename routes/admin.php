<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', 'HomeController@index')->name('dashboard');

/**
 * Course
 */
Route::prefix('course')->group(function(){
    //categories
    Route::get('categories', 'CourseCategoryController@index')->name('course.category');
    Route::post('categories', 'CourseCategoryController@storeOrUpdate');
    Route::get('all/categories', 'CourseCategoryController@getData');
    Route::get('get/category', 'CourseCategoryController@edit');
    Route::delete('remove/categories', 'CourseCategoryController@destroy');

    //courses
    Route::get('/', 'CourseController@index')->name('courses');
    Route::get('create', 'CourseController@create')->name('course.add');
    Route::post('create', 'CourseController@store');
    Route::get('all-courses', 'CourseController@getData');
    Route::get('/get-course', 'CourseController@edit');
    Route::put('update/{id}', 'CourseController@update')->name('course.update');
    Route::delete('remove', 'CourseController@destroy');

    //units
    Route::get('/units', 'CourseUnitController@index')->name('units');
    Route::get('add-unit', 'CourseUnitController@create')->name('course.unit');
    Route::post('add-unit', 'CourseUnitController@store');
    Route::get('all-units', 'CourseUnitController@getData');
    Route::get('get-unit', 'CourseUnitController@edit');
    Route::put('update/{id}/unit', 'CourseUnitController@update')->name('unit.update');
    Route::delete('remove/unit', 'CourseUnitController@destroy');


    //Steps
    Route::get('steps', 'CourseUnitStepController@index')->name('course.steps');
    Route::get('get-steps', 'CourseUnitStepController@getAllSteps');
    Route::post('/steps', 'CourseUnitStepController@store')->name('course.step');
    Route::get('/get-step', 'CourseUnitStepController@edit');
    Route::delete('remove/steps', 'CourseUnitStepController@destroy');
});



/**
 * Unit
 */
Route::post('get-unit', 'CourseUnitController@getUnits')->name('get.unit');



/**
 * Share Resources
 */
Route::get('share-resources', 'ResourceController@index')->name('share.resource');
Route::post('share-resources', 'ResourceController@store');



/**
 * Files
 */
Route::prefix('files')->group(function(){
    Route::get('units', 'CourseUnitController@files')->name('unit.files');
    Route::post('units', 'CourseUnitController@storeFile');
});


/**
 * Student
 */
Route::prefix('students')->group(function(){
    Route::get('/', 'StudentController@index')->name('students');

    Route::get('enrollment', 'StudentController@create')->name('student.enrollment');
    Route::post('enrollment', 'StudentController@store');

    Route::get('{id}/profile', 'StudentController@profile')->name('assign');
    Route::post('{id}/assign-unit', 'CourseUnitController@assign')->name('unit.assign');
    Route::delete('{id}/remove-assigned-unit', 'CourseUnitController@removeAssignedUnit')->name('remove.assign');
});


/**
 * Teacher
 */
Route::prefix('instructors')->group(function(){
    Route::get('/', 'TutorController@index')->name('instructors');

    Route::get('add-instructor', 'TutorController@create')->name('instructor.add');
    Route::post('add-instructor', 'TutorController@store');
});


/**
 * Announcement
 */
Route::get('events', 'AdminController@events')->name('events');
Route::get('/announcements', 'AdminController@notice')->name('announcement');
Route::get('/post-new/announcement', 'AdminController@noticeCreate')->name('announcement.post');
Route::post('/post-new/announcement', 'AdminController@noticeStore');


/**
 * Settings
 */
Route::prefix('settings')->group(function(){
    Route::get('profile', 'AdminController@profileSettings')->name('profile');
    Route::post('profile', 'AdminController@profileUpdate')->name('userProfileUpdate');
});


require __DIR__.'/auth.php';
