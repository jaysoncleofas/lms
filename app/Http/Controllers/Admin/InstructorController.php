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
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.instructor.index', compact('instructors'));
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
        if($request->password){
            $request->validate([
                'password' => 'string|min:6|max:255',
            ]);
        }

        $user = User::create([
            'role'      => 'instructor',
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName'  => $request->lastName,
            // 'birthDate' => $request->formatted_birthDate_submit,
            'username'  => $request->username,
            'email'     => $request->email,
            'mobileNumber'     => $request->mobileNumber,
            'password'  => $request->password == '' ? bcrypt('secret') : bcrypt($request->password),
        ]);

        session()->flash('status', 'Successfully added!');
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
        $sections = Section::where('course_id', $course->id)->where('instructor_id', $instructor->id)->orderBy('name', 'asc')->where('isActive', true)->get();

        return view('admin.instructor.course', compact('instructor', 'course', 'sections'));
    }

    public function section($instructor_id, $course_id, $section_id)
    {
        $instructor = User::findOrFail($instructor_id);
        $course = $instructor->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->where('instructor_id', $instructor->id)->where('isActive', true)->findOrFail($section_id);

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
            'firstName' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'lastName'  => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'middleName'  => 'nullable|regex:/^[\pL\s\-]+$/u|max:255',
            // 'birthDate' => 'required|max:255',
        ]);

        // check if request email is not equal to users email then validate
        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'required|string|email|unique:users|max:255',
            ]);
        }
         // check if request userName is not equal to users userName then validate
        elseif($request->username != $user->username){
            $request->validate([
                'username' => 'required|string|unique:users|max:255',
            ]);
        }


        if ($request->mobileNumber != $user->mobileNumber) {
            $request->validate([
                'mobileNumber'=> 'nullable|digits:11|unique:users',
            ]);
        }
         // check if user type a password then validate
        elseif($request->password){
            $request->validate([
                'password' => 'string|min:6|max:255',
            ]);
        }

        $user->update([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName'  => $request->lastName,
            // 'birthDate' => $request->formatted_birthDate_submit,
            'username'  => $request->username,
            'email'     => $request->email,
            'mobileNumber'     => $request->mobileNumber,
            'password'  => $request->password == '' ? $user->password : bcrypt($request->password),
        ]);

        session()->flash('status', 'Successfully updated!');
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
        $user->courses()->detach();
        $user->delete();

        session()->flash('status', 'Successfully deleted!');
        session()->flash('type', 'success');

        return redirect()->route('admin.instructor.index');
    }
}
