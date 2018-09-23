@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>
    <div class="row mt-lg-3 justify-content-center">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-3 d-flex justify-content-between align-items-center">
                        <p><i class="fa fa-file"></i> <a href="{{route('student.lesson.download', [$course->id, $section->id, $lesson->id])}}">{{substr($lesson->upload_file,
                                20)}}</a>
                            <p>
                                <a href="{{route('student.lesson.index', [$course->id, $section->id])}}" class="btn btn-danger">Back</a>

                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-center text-oswald py-4">{{$lesson->title}}</h2>

                            <p class="text-justify">{!! $lesson->description !!}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
