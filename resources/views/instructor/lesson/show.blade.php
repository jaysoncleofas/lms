@extends('layouts.app')

@section('content')
    <div class="container-fluid">

            <div class="row px-3 d-flex justify-content-between align-items-center">
                    <h3 class="text-oswald">{{$course->name}} / Lesson</h3>
                    <a href="{{route('instructor.lesson.index', $course->id)}}" class="btn btn-danger">Back</a>
                </div>

        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                      <div class="row mx-3 d-flex justify-content-between align-items-center">

                          @if (count($lesson->sections) > 0)
                              <div>
                                    Lesson for
                                    @foreach ($lesson->sections as $value)
                                        <span class="breadcrumb-item active">{{$value->name}}</span>
                                    @endforeach
                                <p><i class="fa fa-file"></i> <a href="{{route('instructor.lesson.download', [$course->id, $lesson->id])}}">{{substr($lesson->upload_file, 20)}}</a><p>
                              </div>
                          @endif
                          <a href="{{route('instructor.lesson.edit', [$course->id, $lesson->id])}}" class="pull-right"><i class="fa fa-pencil"></i> Update</a>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                              <h2 class="text-center py-5 text-oswald">{{$lesson->title}}</h2>

                              <p>{{$lesson->description}}</p>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
