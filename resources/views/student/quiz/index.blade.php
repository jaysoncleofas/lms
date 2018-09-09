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
                    <span class="breadcrumb-item active">Quiz</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-12 col-md-12 mb-5 pb-5">
                {{-- @if (count($->section) > 0) --}}
                    
                <div class="card mt-5">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Quiz</th>
                                    <th>Time limit</th>
                                    <th>Score</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($section->quizzes as $key => $quiz)
                                        <tr>
                                            <th>{{$key+1}}</th>
                                            <td><a href="">{{$quiz->title}}</a></td>
                                            <td>23minutes</td>
                                            <td>none</td>
                                            <td>
                                                <a href="{{route('student.quiz.show', [$course->id, $section->id, $quiz->id])}}">Take</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
