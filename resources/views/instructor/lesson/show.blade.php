@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row px-3 d-flex justify-content-between align-items-center">
            <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
            {{-- <a href="{{route('instructor.lesson.index', $course->id)}}" class="btn btn-danger">Back</a> --}}
        </div>
        <div class="row mt-3 justify-content-center">
            <div class="col-lg-12 col-md-12 mb-4">
                <div class="row px-3 d-flex justify-content-between align-items-center">
                    <h3 class="text-oswald">Show Lesson</h3>
                    <a href="{{route('instructor.lesson.edit', [$course->id, $lesson->id])}}" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Update</a>
                </div>
                <div class="card mt-3">
                  <div class="card-body">
                      <div class="row justify-content-center">
                          <div class="col-md-11">
                              <h2 class="text-center py-3 text-oswald">{{$lesson->title}}</h2>
                              <p>{!! $lesson->description !!}</p>
                              <hr>
                              <div class="float-left">
                                  @if ($lesson->upload_file)
                                    <p class="mb-0"><i class="fa fa-file"></i> <a href="{{route('instructor.lesson.download', [$course->id, $lesson->id])}}" class="btn-link" data-toggle="tooltip" title="Download">{{substr($lesson->upload_file, 20)}}</a><p>
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
