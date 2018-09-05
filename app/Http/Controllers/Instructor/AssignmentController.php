<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Assignment;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($course_id, $section_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $assignments = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

         return view('instructor.assignment.index', compact('course', 'section', 'assignments'));
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($course_id, $section_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $sections = Section::where('course_id', $course_id)->get();

         return view('instructor.assignment.create', compact('course', 'section', 'sections'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $course_id, $section_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course_id)->findOrFail($section_id);

         $request->validate([
             'title' => 'required|string|max:255',
         ]);

         $assignment = new Assignment;
         $assignment->instructor_id = $user->id;
         $assignment->course_id = $course->id;
         $assignment->title = $request->title;
         $assignment->save();

         $assignment->sections()->sync($request->sections, false);

         session()->flash('status', 'Successfully added!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.assignment.index', [$course->id, $section_id]);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($course_id, $section_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('course_id', $course_id)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.assignment.edit', compact('course', 'section', 'assignment', 'section22', 'sections'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $course_id, $section_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $request->validate([
             'title' => 'required|string|max:255',
         ]);

         $assignment->title = $request->title;
         $assignment->save();

         if (isset($request->sections)) {
             $assignment->sections()->sync($request->sections);
         } else {
             $assignment->sections()->sync(array());
         }

         session()->flash('status', 'Successfully Updated!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.assignment.index', [$course->id, $section_id]);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($course_id, $section_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $assignment->sections()->detach();
         $assignment->delete();

         session()->flash('status', 'Successfully Deleted!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.assignment.index', [$course->id, $section_id]);
     }
}
