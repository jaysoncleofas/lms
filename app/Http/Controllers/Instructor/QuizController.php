<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Quiz;

class QuizController extends Controller
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

         $quizzes = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

         return view('instructor.quiz.index', compact('course', 'quizzes'));
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

         $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();

         return view('instructor.quiz.create', compact('course', 'sections'));
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
         ]);

         $quiz = new Quiz;
         $quiz->instructor_id = $user->id;
         $quiz->course_id = $course->id;
         $quiz->title = $request->title;
         $quiz->timeLimit = $request->minutes ?? 20;
         $quiz->save();

         $quiz->sections()->sync($request->sections, false);

         session()->flash('status', 'Successfully added!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.quiz.index', $course->id);
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

         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.quiz.edit', compact('course', 'quiz', 'section22', 'sections'));
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

         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $request->validate([
             'title' => 'required|string|max:255',
         ]);

         $quiz->title = $request->title;
         $quiz->timeLimit = $request->minutes;
         $quiz->save();

         if (isset($request->sections)) {
             $quiz->sections()->sync($request->sections);
         } else {
             $quiz->sections()->sync(array());
         }

         session()->flash('status', 'Successfully Updated!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.quiz.index', [$course->id]);
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

         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $quiz->sections()->detach();
         $quiz->delete();

         session()->flash('status', 'Successfully Deleted!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.quiz.index', [$course->id]);
     }

     public function status(Request $request, $course_id, $quiz_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
 
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($quiz_id);
 
         $quiz->isActive = $request->status == 1 ? true : false;
         $quiz->save();
 
         session()->flash('status', 'Successfully updated!');
         session()->flash('type', 'success');
 
         return redirect()->route('instructor.quiz.index', $course->id);
     }
}
