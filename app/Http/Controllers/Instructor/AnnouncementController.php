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
    public function index($course_id)
    {
        $user = Auth::user();
        $course = $user->courses()->findOrFail($course_id);
        // $section = Section::where('course_id', $course->id)->findOrFail($id);

        $announcements = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->latest()->get();

        // return view('instructor.announcement.index', compact('course', 'section', 'announcements'));
        return view('instructor.announcement.index', compact('course', 'announcements'));
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

        return view('instructor.announcement.create', compact('course', 'sections'));
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
            'content' => 'required|string|max:255',
        ]);

        $announcement = new Announcement;
        $announcement->instructor_id = $user->id;
        $announcement->course_id = $course->id;
        $announcement->content = $request->content;
        $announcement->save();

        $announcement->sections()->sync($request->sections, false);

        session()->flash('status', 'Successfully added!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', $course->id);
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
        // $section = Section::where('course_id', $course->id)->findOrFail($section_id);

        $announcement = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

        $sections = Section::where('instructor_id', $user->id)->where('course_id', $course_id)->get();
        $section22 = array();
        foreach ($sections as $section2) {
            $section22[$section2->id] = $section2->title;
        }

        return view('instructor.announcement.edit', compact('course', 'section22', 'sections', 'announcement'));
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
        // $section = Section::where('course_id', $course->id)->findOrFail($section_id);

        $announcement = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $announcement->content = $request->content;
        $announcement->save();

        session()->flash('status', 'Successfully Updated!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', $course->id);
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

        $announcement = Announcement::where('instructor_id', $user->id)->where('course_id', $course_id)->findOrFail($id);
        $announcement->sections()->detach();
        $announcement->delete();

        session()->flash('status', 'Successfully Deleted!');
        session()->flash('type', 'success');

        return redirect()->route('instructor.announcement.index', $course->id);
    }
}
