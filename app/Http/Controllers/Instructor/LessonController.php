<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Lesson;

class LessonController extends Controller
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

         $lessons = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

         return view('instructor.lesson.index', compact('course', 'section', 'lessons'));
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

         // return $section;

         return view('instructor.lesson.create', compact('course', 'section', 'sections'));
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
             'title' => 'required|string|unique:lessons|max:255',
             'content' => 'required|string',
         ]);

         $lesson = new Lesson;
         $lesson->instructor_id = $user->id;
         $lesson->course_id = $course->id;
         $lesson->title = $request->title;
         $lesson->content = $request->content;
         $lesson->save();

         $lesson->sections()->sync($request->sections, false);

         session()->flash('status', 'Successfully added!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.lesson.index', [$course->id, $section_id]);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($course_id, $section_id, $id)
     {
         $user = Auth::user();
         $course = $user->courses()->findOrFail($course_id);
         $section = Section::where('course_id', $course->id)->findOrFail($section_id);

         $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('course_id', $course_id)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.lesson.show', compact('course', 'section', 'lesson', 'section22', 'sections'));
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

         $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $sections = Section::where('course_id', $course_id)->get();
         $section22 = array();
         foreach ($sections as $section2) {
             $section22[$section2->id] = $section2->title;
         }
         return view('instructor.lesson.edit', compact('course', 'section', 'lesson', 'section22', 'sections'));
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

         $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

         $request->validate([
             'title' => 'required|string|max:255',
             'content' => 'required|string',
         ]);

         $lesson->title = $request->title;
         $lesson->content = $request->content;
         $lesson->save();

         if (isset($request->sections)) {
             $lesson->sections()->sync($request->sections);
         } else {
             $lesson->sections()->sync(array());
         }

         session()->flash('status', 'Successfully Updated!');
         session()->flash('type', 'success');

         return redirect()->route('instructor.lesson.index', [$course->id, $section_id]);
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

        $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

        $lesson->sections()->detach();
        $lesson->delete();

        session()->flash('status', 'Successfully Deleted!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.lesson.index', [$course->id, $section_id]);
    }

    public function status(Request $request, $course_id, $section_id, $lesson_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->findOrFail($section_id);

        $lesson = Lesson::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($lesson_id);

        $lesson->status = $request->status == 1 ? true : false;
        $lesson->save();

        session()->flash('status', 'Successfully Updated!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.lesson.index', [$course->id, $section_id]);
    }
}
