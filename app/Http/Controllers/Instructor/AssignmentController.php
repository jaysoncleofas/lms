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
     public function index($course_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $assignments = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

         return view('instructor.assignment.index', compact('course', 'assignments'));
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($course_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->get();

         return view('instructor.assignment.create', compact('course', 'sections'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $course_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $request->validate([
             'title' => 'required|string|max:255',
             'deadline' => 'required|string|max:255',
         ]);

         $assignment = new Assignment;
         $assignment->instructor_id = $user->id;
         $assignment->course_id = $course->id;
         $assignment->title = $request->title;
         $assignment->expireDate = $request->formatted_deadline_submit;
         $assignment->save();

         $assignment->sections()->sync($request->sections, false);

         session()->flash('status', 'Successfully saved!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.assignment.index', $course->id);
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
     public function edit($course_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.assignment.edit', compact('course', 'assignment', 'section22', 'sections'));
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

         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $request->validate([
             'title' => 'required|string|max:255',
             'deadline' => 'required|string|max:255',
         ]);

         $assignment->title = $request->title;
         $assignment->expireDate = $request->formatted_deadline_submit;
         $assignment->save();

         if (isset($request->sections)) {
             $assignment->sections()->sync($request->sections);
         } else {
             $assignment->sections()->sync(array());
         }

         session()->flash('status', 'Successfully updated!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.assignment.index', $course->id);
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
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $assignment->sections()->detach();
         $assignment->delete();

         session()->flash('status', 'Successfully deleted!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.assignment.index', $course->id);
     }

     public function status(Request $request, $course_id, $assignment_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
 
         $assignment = Assignment::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($assignment_id);
 
         $assignment->isActive = $request->status == 1 ? true : false;
         $assignment->save();
 
         session()->flash('status', 'Successfully updated!');
         session()->flash('type', 'success');
 
         return redirect()->route('instructor.assignment.index', $course->id);
     }
}
