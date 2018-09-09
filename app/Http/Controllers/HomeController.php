<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
use App\Course;
use Auth;
use App\Token;
use Hash;
use App\Section;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['register_token', 'register_student', 'check_token', 'register', 'privacy_policy']);
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
        $token = Token::where('token', $request->classToken)->where('status', true)->first();

        if(isset($token)){
            if($token->token == $request->classToken){
                return redirect()->route('privacy_policy', $token->token);
            } 
        }
        session()->flash('status', 'Invalid token!');
                session()->flash('type', 'error');
                return redirect()->back();
    }

    public function register_student($token)
    {
        $section = Token::where('token', $token)->where('status', true)->firstOrFail();

        if(isset($section)){
            if($section->token == $token){
                return view('auth.register', compact('section'));
            } 
            session()->flash('status', 'Invalid token!');
            session()->flash('type', 'error');
            return redirect()->back();
        }
    }

    public function privacy_policy($token)
    {
        $section = Token::where('token', $token)->where('status', true)->firstOrFail();

        if(isset($section)){
            if($section->token == $token){
                return view('auth.privacy_policy', compact('section'));
            } 
            session()->flash('status', 'Invalid token!');
            session()->flash('type', 'error');
            return redirect()->back();
        }
    }

    public function register(Request $request, $section)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'birthDate' => 'required|max:255',
            'username'  => 'required|string|unique:users|max:255',
            'email'     => 'required|string|email|unique:users|max:255',
            'password'  => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'role'      => 'student',
            'firstName' => $request->firstName,
            'middleName'=> $request->middleName,
            'lastName'  => $request->lastName,
            'birthDate' => $request->formatted_birthDate_submit,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $user->sections()->sync($request->sections, false);

        return redirect()->route('student.dashboard');

    }

    public function student_dashboard()
    {
        $user = Auth::user();
        return view('student.dashboard', compact('user'));
    }
}
