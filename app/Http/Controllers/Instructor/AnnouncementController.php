<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Course;
use App\User;
use App\Section;
use App\Announcement;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id, $id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        $section = Section::where('course_id', $course->id)->findOrFail($id);

        $announcements = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->where('section_id', $id)->latest()->get();

        return view('instructor.announcement.index', compact('course', 'section', 'announcements'));
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

        return view('instructor.announcement.create', compact('course', 'section'));
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
        $section = Section::where('course_id', $course->id)->findOrFail($section_id);

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $announcement = new Announcement;
        $announcement->instructor_id = $user->id;
        $announcement->course_id = $course->id;
        $announcement->section_id = $section_id;
        $announcement->content = $request->content;
        $announcement->save();

        session()->flash('status', 'Successfully added!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', [$course->id, $section_id]);
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

        $announcement = Announcement::where('course_id', $course_id)->where('section_id', $section_id)->findOrFail($id);

        return view('instructor.announcement.edit', compact('course', 'section', 'announcement'));
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

        $announcement = Announcement::where('course_id', $course_id)->where('section_id', $section_id)->findOrFail($id);

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $announcement->content = $request->content;
        $announcement->save();

        session()->flash('status', 'Successfully Updated!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', [$course->id, $section_id]);
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

        $announcement = Announcement::where('course_id', $course_id)->where('section_id', $section_id)->findOrFail($id);

        $announcement->delete();

        session()->flash('status', 'Successfully Deleted!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', [$course->id, $section_id]);
    }
}
