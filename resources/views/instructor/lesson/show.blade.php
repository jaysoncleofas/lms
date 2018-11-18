@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>{{ $course->name }}</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-lg-12 col-md-12 mb-3">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="text-oswald mb-0">Show Lesson</h5>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <h2 class="text-center py-3 text-oswald">{{$lesson->title}}</h2>
                                <p>{!! $lesson->description !!}</p>
                                <hr>
                                <div class="float-left">
                                    @if ($lesson->upload_file)
                                        <p class="mb-0"><i class="fa fa-file"></i> <a href="{{route('instructor.lesson.download', [$course->id, $lesson->id])}}" class="btn-link" data-toggle="tooltip" data-placement="right" title="Download">{{substr($lesson->upload_file, 11)}}</a><p>
                                    @endif
                                        Lesson for:
                                        @foreach ($lesson->sections as $value)
                                            <span class="breadcrumb-item active">{{$value->name}}</span>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            {{-- <a href="{{route('instructor.lesson.edit', [$course->id, $lesson->id])}}" class="pull-right"><i class="fa fa-pencil"></i> Update</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
