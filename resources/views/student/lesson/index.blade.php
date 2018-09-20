@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->lessons)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Lesson{{count($section->lessons) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lesson</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->lessons as $key => $lesson)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$lesson->title}}</td>
                        <td><a class="blue-text" href="{{route('student.lesson.download', [$course->id, $section->id, $lesson->id])}}">{{substr($lesson->upload_file, 20)}}</a></td>
                        <td><a class="blue-text" href="{{route('student.lesson.show',[$course->id, $section->id, $lesson->id])}}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
