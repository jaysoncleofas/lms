<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instructors = User::where('role', 'instructor')->get();

        return view('admin.course.create', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:courses|max:255',
        ]);

        $course = new Course;
        $course->name = $request->name;
        $course->code = $request->code;
        $course->description = $request->description;
        $course->save();

        $course->users()->sync($request->instructors, false);

        session()->flash('status', 'Successfully added!');
        session()->flash('type', 'success');

        return redirect()->route('admin.course.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        $instructors = User::where('role', 'instructor')->get();
        $instructors2 = array();
        foreach ($instructors as $instructor) {
            $instructors2[$instructor->id] = $instructor->firstName;
        }
        return view('admin.course.edit', compact('course', 'instructors2', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if ($request->name != $course->name) {
            $request->validate([
                'name' => 'required|string|unique:courses|max:255',
            ]);
        }

        $course->name = $request->name;
        $course->code = $request->code;
        $course->description = $request->description;
        $course->save();

        if (isset($request->instructors)) {
            $course->users()->sync($request->instructors);
        } else {
            $course->users()->sync(array());
        }



        session()->flash('status', 'Successfully updated!');
        session()->flash('type', 'success');

        return redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->users()->detach();
        $course->delete();

        session()->flash('status', 'Successfully deleted!');
        session()->flash('type', 'success');

        return redirect()->back();
    }
}
