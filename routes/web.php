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
Route::get('/register/privacy-policy/{token}', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('/register/{token}', 'HomeController@register_student')->name('register_student');
Route::post('/register/student/{section}', 'HomeController@register')->name('register.student');

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['admin', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@admin_dashboard')->name('dashboard');
    Route::resource('/course', 'Admin\CourseController');
    Route::resource('/instructor', 'Admin\InstructorController');
});

Route::prefix('instructor')->name('instructor.')->middleware(['instructor', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@instructor_dashboard')->name('dashboard');
    Route::resource('/course/{course}/section', 'Instructor\SectionController')->except('show');

    Route::resource('/course/{course}/announcement', 'Instructor\AnnouncementController')->except(['show']);

    Route::resource('/course/{course}/section/{section}/student', 'Instructor\StudentController')->except(['show']);

    Route::put('/course/{course}/lesson/{lesson}/status', 'Instructor\LessonController@status')->name('lesson.status');
    Route::resource('/course/{course}/lesson', 'Instructor\LessonController');

    Route::resource('/course/{course}/quiz', 'Instructor\QuizController');

    Route::resource('/course/{course}/assignment', 'Instructor\AssignmentController');

    Route::resource('/course/{course}/token', 'Instructor\TokenController')->except(['show']);

    Route::resource('/course/{course}/quiz/{quiz}/question', 'Instructor\QuestionController');
});


Route::prefix('student')->name('student.')->middleware(['student', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@student_dashboard')->name('dashboard');
    Route::get('/course/{course}/section/{section}/announcement', 'StudentController@announcement')->name('announcement');
    // lesson
    Route::get('/course/{course}/section/{section}/lesson', 'StudentController@lesson_index')->name('lesson.index');
    Route::get('/course/{course}/section/{section}/lesson/{lesson}', 'StudentController@lesson_show')->name('lesson.show');
    Route::get('/course/{course}/section/{section}/lesson/{lesson}/download', 'StudentController@lesson_download')->name('lesson.download');

    Route::get('/course/{course}/section/{section}/quiz', 'StudentController@quiz_index')->name('quiz.index');
    Route::get('/course/{course}/section/{section}/quiz/{quiz}', 'StudentController@quiz_show')->name('quiz.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UserController@index')->name('profile.index');
    Route::put('/profile', 'UserController@update')->name('profile.update');
    Route::put('/profile/picture', 'UserController@profile_remove')->name('profile.picture.remove');
    Route::get('/change-password', 'UserController@change_password_index')->name('change.password.index');
});
