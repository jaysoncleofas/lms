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

Route::get('/register-token', 'HomeController@register_token')->name('register_token');
Route::post('/register-token', 'HomeController@check_token')->name('check_token');
Route::get('/register/{id}', 'HomeController@register_student')->name('register_student');

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['admin', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@admin_dashboard')->name('dashboard');
    Route::resource('/course', 'Admin\CourseController');
    Route::resource('/instructor', 'Admin\InstructorController');
});

// Route::prefix('instructor')->name('instructor.')->middleware(['instructor', 'auth'])->group(function () {
//     Route::get('/dashboard', 'HomeController@instructor_dashboard')->name('dashboard');
//     Route::resource('/course/{course}/section', 'Instructor\SectionController')->except('show');
//
//     Route::resource('/course/{course}/section/{section}/announcement', 'Instructor\AnnouncementController')->except(['show']);
//
//     Route::resource('/course/{course}/section/{section}/student', 'Instructor\StudentController')->except(['show']);
//
//     Route::put('/course/{course}/section/{section}/lesson/{lesson}/status', 'Instructor\LessonController@status')->name('lesson.status');
//     Route::resource('/course/{course}/section/{section}/lesson', 'Instructor\LessonController');
//
//     Route::resource('/course/{course}/section/{section}/quiz', 'Instructor\QuizController');
//
//     Route::resource('/course/{course}/section/{section}/assignment', 'Instructor\AssignmentController');
//
//     Route::resource('/course/{course}/section/{section}/token', 'Instructor\TokenController')->except(['show']);
// });

Route::prefix('instructor')->name('instructor.')->middleware(['instructor', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@instructor_dashboard')->name('dashboard');
    Route::resource('/course/{course}/section', 'Instructor\SectionController')->except('show');

    Route::resource('/course/{course}/announcement', 'Instructor\AnnouncementController')->except(['show']);

    // Route::resource('/course/{course}/section/{section}/student', 'Instructor\StudentController')->except(['show']);

    Route::put('/course/{course}/lesson/{lesson}/status', 'Instructor\LessonController@status')->name('lesson.status');
    Route::resource('/course/{course}/lesson', 'Instructor\LessonController');

    Route::resource('/course/{course}/quiz', 'Instructor\QuizController');

    Route::resource('/course/{course}/assignment', 'Instructor\AssignmentController');

    Route::resource('/course/{course}/token', 'Instructor\TokenController')->except(['show']);

    Route::resource('/course/{course}/quiz/{quiz}/question', 'Instructor\QuestionController');
});
