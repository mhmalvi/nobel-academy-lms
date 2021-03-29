<?php

use Illuminate\Http\Request;
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
});


/**
 * Unit
 */
Route::post('get-unit', 'CourseUnitController@getUnits')->name('get.unit');


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
    
    Route::get('course-enrollment', 'CourseEnrollmentController@create')->name('course.enrollment');
    Route::post('course-enrollment', 'CourseEnrollmentController@store');

    Route::get('{id}/unit-assign', 'CourseEnrollmentController@unit')->name('assign');
    Route::post('{id}/unit-assign', 'CourseEnrollmentController@assignUnit');
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
