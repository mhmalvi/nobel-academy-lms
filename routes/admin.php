<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('dashboard', 'HomeController@index')->name('dashboard');

/**
 * Users
 */
Route::prefix('users')->group(function () {
    Route::get('/', 'UsersController@index')->name('users');
    Route::name('user.')->group(function () {
        Route::view('/create', 'admin.users.create')->name('create');
        Route::post('/create', 'UsersController@store');
        Route::get('get', 'UsersController@show')->name('show');
        Route::get('edit/{id}', 'UsersController@edit')->name('edit');
        Route::put('edit/{id}', 'UsersController@update')->name('update');
        Route::delete('users/{id}', 'UsersController@destroy')->name('remove');
        Route::get('trashed', 'UsersController@trashedRecords')->name('trashed');
        Route::get('{id}/profile', 'UsersController@profile')->name('profile');
        Route::put('restore/{id}', 'UsersController@restoreSoftDelete')->name('restore');
        Route::delete('remove/{id}', 'UsersController@permanentDestroy')->name('destroy');
    });
});

/**
 * ClassRooms
 */
Route::prefix('class-rooms')->group(function () {
    Route::get('/', 'ClassroomsController@index')->name('classrooms');
    Route::name('classroom.')->group(function () {
        Route::view('create', 'admin.classrooms.create')->name('create');
        Route::post('create', 'ClassroomsController@store');
    });
});

/**
 * Course
 */
Route::prefix('course')->group(function () {
    //categories
    Route::get('categories', 'CourseCategoryController@index')->name('course.category');
    Route::post('categories', 'CourseCategoryController@storeOrUpdate');
    Route::get('all/categories', 'CourseCategoryController@getData');
    Route::get('get/category', 'CourseCategoryController@edit');
    Route::delete('remove/categories', 'CourseCategoryController@destroy');

    //courses
    Route::get('/', 'CourseController@index')->name('courses');
    Route::view('create', 'admin.course.create')->name('course.add');
    Route::post('create', 'CourseController@store');
    Route::get('all-courses', 'CourseController@getData');
    Route::get('get-course', 'CourseController@edit');
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


    //Share Resources
    Route::get('share-resources', 'ResourceController@index')->name('share.resource');
    Route::post('share-resources', 'ResourceController@store');
});


/**
 * Assesment
 */
Route::get('assesment-requests', 'AssesmentsController@index')->name('assesments');
Route::post('assesment-requests', 'AssesmentsController@update');



/**
 * Unit
 */
Route::post('get-unit', 'CourseUnitController@getUnits')->name('get.unit');




/**
 * Files
 */
Route::prefix('files')->group(function () {
    Route::get('units', 'CourseUnitController@files')->name('unit.files');
    Route::post('units', 'CourseUnitController@storeFile');
});


/**
 * Student
 */
Route::prefix('students')->group(function () {
    Route::get('/', 'StudentController@index')->name('students');

    Route::name('student.')->group(function () {
        Route::get('/{id}/update', 'StudentController@edit')->name('edit');
        Route::put('/{id}/update', 'StudentController@update');
        Route::delete('/{id}/remove', 'StudentController@delete')->name('delete');
    });

    Route::get('enrollment', 'StudentController@create')->name('student.enrollment');
    Route::post('enrollment', 'StudentController@store');


    Route::post('{id}/assign-unit', 'CourseUnitController@assign')->name('unit.assign');
    Route::delete('{id}/remove-assigned-unit', 'CourseUnitController@removeAssignedUnit')->name('remove.assign');
});


/**
 * Teacher
 */
Route::prefix('instructors')->group(function () {
    Route::get('/', 'TutorController@index')->name('instructors');

    Route::get('add-instructor', 'TutorController@create')->name('instructor.add');
    Route::post('add-instructor', 'TutorController@store');
});


/**
 * Announcement
 */
Route::prefix('announcements')->group(function () {
    Route::get('events', 'AdminController@events')->name('events');
    Route::get('/', 'AdminController@notice')->name('announcement');
    Route::get('/post', 'AdminController@noticeCreate')->name('announcement.post');
    Route::post('/post', 'AdminController@noticeStore');
});


/**
 * Settings
 */
Route::prefix('settings')->group(function () {
    Route::get('profile', 'AdminController@profileSettings')->name('profile');
    Route::post('profile', 'AdminController@profileUpdate')->name('userProfileUpdate');
});


require __DIR__ . '/auth.php';
