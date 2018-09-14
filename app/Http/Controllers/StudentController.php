<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Announcement;
use App\Section;
use Auth;
use App\Lesson;

class StudentController extends Controller
{
    public function announcement($course_id, $section_id)
    {

        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.announcement', compact('user','course', 'section'));
    }

    public function lesson_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.lesson.index', compact('user','course', 'section'));
    }

    public function lesson_show($course_id, $section_id, $lesson_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->whereHas('lessons', function ($query) use ($lesson_id) {
            $query->where('lesson_id', $lesson_id);
        })->findOrFail($section_id);

        $lesson = $section->lessons()->findOrFail($lesson_id);

        return view('student.lesson.show', compact('user','course', 'section', 'lesson'));
    }

    public function quiz_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.quiz.index', compact('user','course', 'section'));
    }

    public function quiz_show($course_id, $section_id, $quiz_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        $quiz = $section->quizzes()->findOrFail($quiz_id);

        // $temp=[];
        // foreach($quiz->questions as $question){
        //     $temp[] = $question->correct;
        //     $temp[] = $question->option_one;
        //     $temp[] = $question->option_two;
        //     $temp[] = $question->option_three;
        // }

        // return $temp;




        return view('student.quiz.show', compact('user','course', 'section', 'quiz', 'temp'));
    }

    public function lesson_download($course_id, $section_id, $lesson_id){

        $entry = Lesson::findOrFail($lesson_id);
        $pathToFile = storage_path()."/app/public/files/".$entry->upload_file;
        return response()->download($pathToFile);
    }

    public function section_index($course_id, $section_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        return view('student.section', compact('user','course', 'section'));
    }

}
