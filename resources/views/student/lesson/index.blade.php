@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('student.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <span class="breadcrumb-item active">Section</span>
                    <span class="breadcrumb-item active">{{$section->name}}</span>
                    <span class="breadcrumb-item active">Lesson</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-12 col-md-12 mb-5 pb-5">
                {{-- @if (count($->section) > 0) --}}
                    
                <div class="card mt-5">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lessons</th>
                                <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($section->lessons as $key => $lesson)
                                    <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td><a href="{{route('student.lesson.show',[$course->id, $section->id, $lesson->id])}}" class="blue-text">{{$lesson->title}}</a></td>
                                        {{-- <td>{{asset('storage/files/'.$lesson->upload_file)}}</td> --}}
                                        <td><a href="{{route('student.lesson.download', [$course->id, $section->id, $lesson->id])}}">{{substr($lesson->upload_file, 20)}}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
