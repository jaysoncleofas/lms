<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Quiz;
use Purifier;
use App\Mail\newQuiz;
use Illuminate\Support\Facades\Mail;

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
         $data['course'] = $user->courses()->findOrFail($course_id);
         $data['quizzes'] = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->oldest()->get();
         return view('instructor.quiz.index', $data);
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($course_id)
     {
         $user = Auth::user();
         $data['course'] = $user->courses()->findOrFail($course_id);
         $data['sections'] = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();
         return view('instructor.quiz.create', $data);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $course_id)
     {
         $request->validate([
             'title' => 'required|unique:quizzes|string|max:255',
             'startDate' => 'required|string|max:255',
             'expireDate' => 'required|string|max:255',
             'minutes' => 'required|string|max:255',
             'sections' => 'required',
         ]);

         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $quiz = new Quiz;
         $quiz->instructor_id = $user->id;
         $quiz->course_id = $course->id;
         $quiz->title = $request->title;
         $quiz->timeLimit = $request->minutes ?? 20;
         $quiz->startDate = $request->formatted_startDate_submit;
         $quiz->expireDate = $request->formatted_expireDate_submit;
         $quiz->save();

         $quiz->sections()->sync($request->sections, false);
         $msg = 'There\'s a new quiz in your course '.$quiz->course->name;

        //  foreach($quiz->sections as $section){
        //     foreach($section->users as $user){
        //         if($user->mobileNumber){
        //             $mobile = $user->mobileNumber;
        //             $message = \App\Helpers\SMS::send($mobile, $msg);
        //         }
        //     }
        //     Mail::to($user->email)->send(new newQuiz($user, $quiz));
        // }

         session()->flash('status', 'Successfully added');
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
         $request->validate([
             'title' => 'required|unique:quizzes,title,'.$id.'id|string|max:255',
             'startDate' => 'required|string|max:255',
             'expireDate' => 'required|string|max:255',
             'minutes' => 'required|string|max:255',
             'sections' => 'required',
         ]);

         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $quiz->title = $request->title;
         $quiz->timeLimit = $request->minutes;
         $quiz->startDate = $request->formatted_startDate_submit;
         $quiz->expireDate = $request->formatted_expireDate_submit;
         $quiz->save();

         if (isset($request->sections)) {
             $quiz->sections()->sync($request->sections);
         } else {
             $quiz->sections()->sync(array());
         }

         session()->flash('status', 'Successfully updated');
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
         $quiz->questions()->delete();
         $quiz->sections()->detach();
         $quiz->delete();

         session()->flash('status', 'Successfully deleted');
         session()->flash('type', 'success');
         return response('success', 200);
     }

     public function status(Request $request, $course_id, $quiz_id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $quiz = Quiz::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($quiz_id);
         $quiz->isActive = $request->status == 1 ? true : false;
         $quiz->save();

         $status = $request->status == 1 ? 'activated' : 'deactivated';
         session()->flash('status', 'Successfully '.$status);
         session()->flash('type', 'success');
         return response('success', 200);
     }
}
