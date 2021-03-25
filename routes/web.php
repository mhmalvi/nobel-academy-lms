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
    Route::get('/', function () {
        return view('welcome');
    })->name('index');
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');


    Route::prefix('course')->group(function () {
        Route::get('{id}/student', 'CourseController@index')->name('course');
        Route::get('{id}/instructor', 'CourseController@course')->name('teacher.course');
    });
    
    Route::prefix('unit')->group(function () {
        Route::get('{unique_id}/core-unit', 'CourseController@coreUnit')->name('core');
        Route::get('{unique_id}/elective-unit', 'CourseController@elctiveUnit')->name('elective');
    });
    
    Route::get('file-upload', 'FileController@index')->name('file');
    Route::post('file-upload', 'FileController@store');
    Route::get('download/{file}', 'FileController@fileDownload')->name('download.unitFile');
    
    Route::get('calendar', 'CalendarController@index')->name('calendar');
    
    Route::get('edit-profile', 'AppController@userProfile')->name('edit.profile');
    Route::post('edit-profile', 'AppController@updateProfileInfo');
});

require __DIR__.'/auth.php';
