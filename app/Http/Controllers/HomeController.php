<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        $instructor_total = User::where('role', 'instructor')->count();
        $course_total = Course::count();

        return view('admin.dashboard', compact('instructor_total', 'course_total'));
    }

    public function instructor_dashboard()
    {
        return view('instructor.dashboard');
    }
}
