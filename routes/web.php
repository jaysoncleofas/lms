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
    Route::put('/course/{course}/section/{section}/status', 'Instructor\SectionController@status')->name('section.status');
    Route::resource('/course/{course}/section', 'Instructor\SectionController')->except('show');

    Route::resource('/course/{course}/announcement', 'Instructor\AnnouncementController')->except(['show']);

    Route::resource('/course/{course}/section/{section}/student', 'Instructor\StudentController')->except(['show']);

    Route::get('/course/{course}/lesson/download/{lesson}', 'Instructor\LessonController@download')->name('lesson.download');
    Route::put('/course/{course}/lesson/{lesson}/status', 'Instructor\LessonController@status')->name('lesson.status');
    Route::resource('/course/{course}/lesson', 'Instructor\LessonController');

    Route::put('/course/{course}/quiz/{quiz}/status', 'Instructor\QuizController@status')->name('quiz.status');
    Route::resource('/course/{course}/quiz', 'Instructor\QuizController');

    Route::put('/course/{course}/assignment/{assignment}/status', 'Instructor\AssignmentController@status')->name('assignment.status');
    Route::resource('/course/{course}/assignment', 'Instructor\AssignmentController');

    Route::resource('/course/{course}/token', 'Instructor\TokenController')->except(['show']);

    Route::resource('/course/{course}/quiz/{quiz}/question', 'Instructor\QuestionController');

    Route::get('/course/{course}/assignment/{assignment}/question', 'Instructor\QuestionAssignmentController@index')->name('question.assignmentIndex');
    Route::get('/course/{course}/assignment/{assignment}/question/create', 'Instructor\QuestionAssignmentController@create')->name('question.assignmentCreate');
    Route::post('/course/{course}/assignment/{assignment}/question', 'Instructor\QuestionAssignmentController@store')->name('question.assignmentStore');
    Route::get('/course/{course}/assignment/{assignment}/question/{question}/edit', 'Instructor\QuestionAssignmentController@edit')->name('question.assignmentEdit');
    Route::put('/course/{course}/assignment/{assignment}/question/{question}', 'Instructor\QuestionAssignmentController@update')->name('question.assignmentUpdate');
    Route::delete('/course/{course}/assignment/{assignment}/question/{question}', 'Instructor\QuestionAssignmentController@destroy')->name('question.assignmentDestroy');
});


Route::prefix('student')->name('student.')->middleware(['student', 'auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@student_dashboard')->name('dashboard');
    Route::get('/course/{course}/section/{section}/announcement', 'StudentController@announcement')->name('announcement');
    Route::get('/course/{course}/section/{section}', 'StudentController@section_index')->name('section.index');
    // lesson
    Route::get('/course/{course}/section/{section}/lesson', 'StudentController@lesson_index')->name('lesson.index');
    Route::get('/course/{course}/section/{section}/lesson/{lesson}', 'StudentController@lesson_show')->name('lesson.show');
    Route::get('/course/{course}/section/{section}/lesson/{lesson}/download', 'StudentController@lesson_download')->name('lesson.download');

    Route::get('/course/{course}/section/{section}/quiz', 'StudentController@quiz_index')->name('quiz.index');
    Route::get('/course/{course}/section/{section}/quiz/{quiz}', 'StudentController@quiz_show')->name('quiz.show');

    Route::get('/course/{course}/section/{section}/assignment', 'StudentController@assignment_index')->name('assignment.index');
    Route::get('/course/{course}/section/{section}/assignment/{assignment}', 'StudentController@assignment_show')->name('assignment.show');

    Route::post('/course/{course}/section/{section}/quiz/{quiz}/take', 'TakeController@store')->name('take.store');
    Route::get('/course/{course}/section/{section}/quiz/{quiz}/take/{take}/result', 'TakeController@result')->name('take.result');

    Route::post('/course/{course}/section/{section}/assignment/{assignment}/take', 'TakeController@store_assignment')->name('take.store_assignment');
    Route::get('/course/{course}/section/{section}/assignment/{assignment}/take/{take}/result', 'TakeController@result_assignment')->name('take.result_assignment');

    Route::post('/dashboard/register-token', 'StudentController@check_token')->name('check_token');
    Route::get('/dashboard/register-token/{token}', 'StudentController@course_add')->name('course.add');
    Route::post('/dashboard/register/{section}', 'StudentController@register_store')->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UserController@index')->name('profile.index');
    Route::put('/profile', 'UserController@update')->name('profile.update');
    Route::put('/profile/picture', 'UserController@profile_remove')->name('profile.picture.remove');
    Route::get('/change-password', 'UserController@change_password_index')->name('change.password.index');
    Route::put('/change-password', 'UserController@change_password_update')->name('change.password.update');
    Route::get('/my-files', 'UserController@my_files')->name('my_files');
    Route::post('/my-files', 'UserController@files_store')->name('my_files.store');
    Route::get('/my-files/download/{file}', 'UserController@files_download')->name('my_files.download');
    Route::delete('/my-files/{file}', 'UserController@files_destroy')->name('my_files.destroy');

    Route::post('/new-message', 'MessageController@store')->name('message.store');
    Route::get('/messages', 'MessageController@index')->name('message.index');
});
