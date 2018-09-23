<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($id);
        $sections = Section::where('course_id', $id)->where('instructor_id', $user->id)->orderBy('name', 'asc')->where('isActive', true)->get();
        $sections2 = Section::where('course_id', $id)->where('instructor_id', $user->id)->orderBy('name', 'asc')->where('isActive', false)->get();
        return view('instructor.section.index', compact('course', 'sections', 'sections2'));
    }

    public function deactivated($course_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $sections = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->orderBy('name', 'asc')->where('isActive', true)->get();
        $sections2 = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->orderBy('name', 'asc')->where('isActive', false)->get();
        return view('instructor.section.deactivated', compact('course', 'sections', 'sections2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($id);

        return view('instructor.section.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $section = new Section;
        $section->instructor_id = $user->id;
        $section->course_id = $course->id;
        $section->name = $request->name;
        $section->save();

        session()->flash('status', 'Successfully added!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.section.index', $course->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function announcement($course_id, $id)
    // {
    //     $user = Auth::user();
    //     $course = $user->courses()->findOrFail($course_id);
    //
    //     $section = Section::where('course_id', $course->id)->findOrFail($id);
    //
    //     return view('instructor.section.announcement', compact('course', 'section'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($id);
        return view('instructor.section.edit', compact('course', 'section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($id);


        if ($request->name != $section->name) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
        }

        $section->name = $request->name;
        $section->save();

        session()->flash('status', 'Successfully update!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.section.index', $course->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($id);
        $section->lessons()->detach();
        $section->quizzes()->detach();
        $section->assignments()->detach();
        $section->announcements()->detach();
        $section->users()->detach();
        $section->tokens()->delete();
        $section->takes()->delete();
        $section->passes()->delete();
        $section->delete();

        session()->flash('status', 'Successfully Deleted!');
        session()->flash('type', 'success');

        return redirect()->back();
    }

    public function status(Request $request, $course_id, $section_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->findOrFail($section_id);

        $section->isActive = $request->status == 1 ? true : false;
        $section->save();

        session()->flash('status', 'Successfully updated!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.section.index', $course->id);
    }
}
