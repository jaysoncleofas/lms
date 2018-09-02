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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['admin', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@admin_dashboard')->name('dashboard');
    Route::resource('/course', 'Admin\CourseController');
    Route::resource('/instructor', 'Admin\InstructorController');
});

Route::prefix('instructor')->name('instructor.')->middleware(['instructor', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@instructor_dashboard')->name('dashboard');
    // Route::get('/course/{course}/section/{section}/announcement', 'Instructor\SectionController@announcement')->name('section.announcement');
    Route::get('/course/{course}/sections', 'Instructor\SectionController@index')->name('section.index');
    Route::resource('/course/{course}/section', 'Instructor\SectionController')->except(['show', 'index']);

    Route::resource('/course/{course}/section/{section}/announcement', 'Instructor\AnnouncementController')->except(['show']);

    Route::resource('/course/{course}/section/{section}/student', 'Instructor\StudentController')->except(['show']);

    Route::resource('/course/{course}/section/{section}/token', 'Instructor\TokenController')->except(['show']);
});
