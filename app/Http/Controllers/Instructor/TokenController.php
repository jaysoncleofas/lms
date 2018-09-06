<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Token;
use Carbon\Carbon;

class TokenController extends Controller
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

        $tokens = Token::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

        return view('instructor.token.index', compact('course', 'tokens', 'sections'));
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

         $sections = Section::where('course_id', $course_id)->where('instructor_id', $user->id)->where('isActive', true)->get();

         return view('instructor.token.create', compact('course', 'sections'));
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
            'section' => 'required|max:255',
        ]);

        $token = new Token;
        $token->instructor_id = $user->id;
        $token->course_id = $course_id;
        $token->section_id = $request->section;
        $token->token = str_random(20);
        $token->save();

        session()->flash('status', 'Successfully added!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.token.index', $course->id);
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
    public function edit($id)
    {
        // $user = Auth::user();
        // $course = $user->courses()->findOrFail($course_id);
        // $section = Section::where('course_id', $course->id)->findOrFail($section_id);
        //
        // return view('instructor.token.create', compact('course', 'section'));
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
        // $user = Auth::user();
        // $course = $user->courses()->findOrFail($course_id);
        // $section = Section::where('course_id', $course->id)->findOrFail($section_id);
        //
        // $token = Token::findOrFail($token_id);
        // $token->status = $request->status == 1 ? true : false;
        // $token->save();
        //
        // session()->flash('status', 'Successfully updated!');
        // session()->flash('type', 'success');
        //
        // return redirect()->route('instructor.token.index', [$course->id, $section_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $token_id)
    {
        $token = Token::findOrFail($token_id);

        $token->delete();

        session()->flash('status', 'Successfully Deleted!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.token.index', $course_id);
    }
}
