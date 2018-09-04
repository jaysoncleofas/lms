<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use Auth;
use App\Token;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['register_token', 'register_student', 'check_token']);
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

    public function register_token()
    {
        return view('auth.register_token');
    }

    public function check_token(Request $request)
    {
      // return $request->token;
        $token = Token::where('token', $request->token)->where('status', 1)->get();
        // return $toke+n;
        if ($request->token) {
            return view('auth.register', $token->id);
        } else{
          session()->flash('status', 'Invalid token!');
          session()->flash('type', 'error');
          return redirect()->route('register_token');
        }
        // $course = Token::where('token', $request->token)->where('status', 'active')->get();

    }

    public function register_student($id)
    {
        return view('auth.register');
    }
}
