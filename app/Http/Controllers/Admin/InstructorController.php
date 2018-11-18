<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\Section;
use App\Course;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = User::where('role', 'instructor')->latest()->get();
        return view('admin.instructor.index', compact('instructors'));
    }

    public function trash()
    {
        $instructors = User::where('role', 'instructor')->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('admin.instructor.deleted', compact('instructors'));
    }

    public function restore(Request $request, $id)
    {
        $instructor = User::withTrashed()->findOrFail($id);
        $instructor->instructorSections()->restore();
        $instructor->restore();

        session()->flash('status', 'Successfully restored');
        session()->flash('type', 'success');
        return response('success', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'role'         => 'instructor',
            'firstName'    => $request->firstName,
            'middleName'   => $request->middleName,
            'lastName'     => $request->lastName,
            'username'     => $request->username,
            'email'        => $request->email,
            'mobileNumber' => $request->mobileNumber,
            'password'     => $request->password ? bcrypt($request->password) : bcrypt('secret'),
            'avatar'       => 'profile_pic.png'
        ]);

        session()->flash('status', 'Successfully saved');
        session()->flash('type', 'success');
        return redirect()->route('admin.instructor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instructor = User::findOrFail($id);
        return view('admin.instructor.show', compact('instructor'));
    }

    public function course($instructor_id, $course_id)
    {
        $instructor = User::findOrFail($instructor_id);
        $course = $instructor->courses()->findOrFail($course_id);
        $sections = Section::where('course_id', $course->id)->where('instructor_id', $instructor->id)->orderBy('name', 'asc')->get();

        return view('admin.instructor.course', compact('instructor', 'course', 'sections'));
    }

    public function section($instructor_id, $course_id, $section_id)
    {
        $instructor = User::findOrFail($instructor_id);
        $course = $instructor->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->where('instructor_id', $instructor->id)->findOrFail($section_id);
        return view('admin.instructor.section', compact('instructor', 'course', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instructor = User::where('role', 'instructor')->findOrFail($id);
        return view('admin.instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'firstName'    => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'lastName'     => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'middleName'   => 'nullable|regex:/^[\pL\s\-]+$/u|max:255',
            'username'     => 'required|alpha_dash|unique:users,username,'.$user->id.',id|max:255',
            'email'        => 'required|string|email|unique:users,email,'.$user->id.',id|max:255',
            'mobileNumber' => 'nullable|alpha_num|digits:11|unique:users,mobileNumber,'.$user->id.',id',
            'password'     => 'nullable|string|min:6|max:255',
        ]);

        $user->update([
            'firstName'    => $request->firstName,
            'middleName'   => $request->middleName,
            'lastName'     => $request->lastName,
            'username'     => $request->username,
            'email'        => $request->email,
            'mobileNumber' => $request->mobileNumber,
            'password'     => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        session()->flash('status', 'Successfully updated');
        session()->flash('type', 'success');
        return redirect()->route('admin.instructor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // $user->courses()->detach();
        $user->instructorSections()->delete();
        $user->delete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }

    public function forceDestroy($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->courses()->detach();
        $user->forceDelete();

        session()->flash('status', 'Successfully deleted');
        session()->flash('type', 'success');
        return response('success', 200);
    }
}
