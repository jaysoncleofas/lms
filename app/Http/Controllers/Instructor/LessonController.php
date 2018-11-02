<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Lesson;
use carbon\Carbon;
use Purifier;
use App\Mail\newLesson;
use Illuminate\Support\Facades\Mail;

class LessonController extends Controller
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
         // $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $lessons = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

         return view('instructor.lesson.index', compact('course', 'lessons'));
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

         return view('instructor.lesson.create', compact('course', 'sections'));
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
             'description' => 'required|string',
         ]);

         if ($request->hasFile('upload_file')) {
            $request->validate([
                'upload_file' => 'mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:25000',
            ]);
                    $lessonfile = $request->upload_file;
                    $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                    $name = $timestamp. '-' .$lessonfile->getClientOriginalName();
                    // $image->image = $name;
                    $lessonfile->storeAs('public/files', $name);
        }

         $lesson = new Lesson;
         $lesson->instructor_id = $user->id;
         $lesson->course_id = $course->id;
         $lesson->title = $request->title;
         $lesson->description = Purifier::clean($request->description);
         $lesson->upload_file = $name ?? "";
         $lesson->save();

         $lesson->sections()->sync($request->sections, false);

        $msg = 'There\'s a new uploaded lesson in your course '.$lesson->course->name;

        //  foreach($lesson->sections as $section){
        //     foreach($section->users as $user){
        //         if($user->mobileNumber){
        //             $mobile = $user->mobileNumber;     
        //             $message = \App\Helpers\SMS::send($mobile, $msg);
        //         }
        //     }
        //     Mail::to($user->email)->send(new newLesson($user, $lesson));
        // }
        
         session()->flash('status', 'Successfully added!');
         session()->flash('type', 'success');
         

         return redirect()->route('instructor.lesson.index', $course->id);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($course_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);

         $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('course_id', $course_id)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.lesson.show', compact('course', 'lesson', 'section22', 'sections'));
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

         $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->where('isActive', true)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.lesson.edit', compact('course', 'lesson', 'section22', 'sections'));
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

         $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string',
         ]);

         if ($request->hasFile('upload_file')) {
            $request->validate([
                'upload_file' => 'mimes:pdf,doc,ppt,xls,docx,pptx,xlsx,rar,zip|max:5000',
            ]);
                    $lessonfile = $request->upload_file;
                    $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                    $name = $timestamp. '-' .$lessonfile->getClientOriginalName();
                    // $image->image = $name;
                    $lessonfile->storeAs('public/files', $name);

                    $lesson->upload_file = $name;
        }


         $lesson->title = $request->title;
         $lesson->description = Purifier::clean($request->description);
         $lesson->save();

         if (isset($request->sections)) {
             $lesson->sections()->sync($request->sections);
         } else {
             $lesson->sections()->sync(array());
         }

         session()->flash('status', 'Successfully updated!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.lesson.index', $course->id);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $lesson_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);

        $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($lesson_id);

        $lesson->sections()->detach();
        $lesson->delete();

        session()->flash('status', 'Successfully deleted!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.lesson.index', $course->id);
    }

    public function status(Request $request, $course_id, $lesson_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);

        $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($lesson_id);

        $lesson->status = $request->status == 1 ? true : false;
        $lesson->save();

        session()->flash('status', 'Successfully updated!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.lesson.index', $course->id);
    }

    public function download($course_id, $lesson_id){

        $entry = Lesson::findOrFail($lesson_id);
        $pathToFile = storage_path()."/app/public/files/".$entry->upload_file;
        return response()->download($pathToFile);
    }
}
