<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Take;
use App\TakeAnswer;
use App\Question;
use App\Course;
use App\Section;

class TakeController extends Controller
{
    public function store(Request $request, $course_id, $section_id, $quiz_id)
    {
        $result = 0;
        // return $request->input('questions', []);
        $take = Take::create([
            'user_id' => Auth::id(),
            'section_id' => $section_id,
            'quiz_id' => $quiz_id,
            'result'  => $result,
        ]);


        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
            $questionMaster = Question::find($question);
            if ($request->input('answers.'.$question) != null
                && $request->input('answers.'.$question) == $questionMaster->correct

                // Question::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TakeAnswer::create([
                'user_id'     => Auth::id(),
                'take_id'     => $take->id,
                'question_id' => $question,
                'option'   => $request->input('answers.'.$question),
                'correct'     => $status,
            ]);
        }

        $take->update(['result' => $result]);

        return redirect()->route('student.take.result', [$course_id, $section_id, $quiz_id, $take->id]);
    }

    public function result($course_id, $section_id, $quiz_id, $take_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        $quiz = $section->quizzes()->findOrFail($quiz_id);

        $take = Take::where('quiz_id', $quiz->id)->findOrFail($take_id);

        return view('student.quiz.result', compact('course', 'section', 'quiz', 'take'));
    }

    public function store_assignment(Request $request, $course_id, $section_id, $assignment_id)
    {
        $result = 0;
        // return $request->input('questions', []);
        $take = Take::create([
            'user_id' => Auth::id(),
            'section_id' => $section_id,
            'assignment_id' => $assignment_id,
            'result'  => $result,
        ]);


        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
            $questionMaster = Question::find($question);
            if ($request->input('answers.'.$question) != null
                && $request->input('answers.'.$question) == $questionMaster->correct

                // Question::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            TakeAnswer::create([
                'user_id'     => Auth::id(),
                'take_id'     => $take->id,
                'question_id' => $question,
                'option'   => $request->input('answers.'.$question),
                'correct'     => $status,
            ]);
        }

        $take->update(['result' => $result]);

        return redirect()->route('student.take.result_assignment', [$course_id, $section_id, $assignment_id, $take->id]);
    }

    public function result_assignment($course_id, $section_id, $assignment_id, $take_id)
    {
        $user = Auth::user();
        $course = Course::findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->findOrFail($section_id);

        $assignment = $section->assignments()->findOrFail($assignment_id);

        $take = Take::where('assignment_id', $assignment->id)->findOrFail($take_id);

        return view('student.assignment.result', compact('course', 'section', 'assignment', 'take'));
    }
}
