@extends('layouts.app')

@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <nav class="breadcrumb">
                  <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">Course</a>
                  <span class="breadcrumb-item active">{{$course->name}}</span>
                  <a class="breadcrumb-item" href="{{route('instructor.lesson.index', $course->id)}}">Lesson</a>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                      @if (count($lesson->sections) > 0)
                          Lesson for
                          @foreach ($lesson->sections as $value)
                              <span class="breadcrumb-item active">{{$value->name}}</span>
                          @endforeach
                      @endif
                      <a href="{{route('instructor.lesson.edit', [$course->id, $lesson->id])}}" class="pull-right"><i class="fa fa-pencil"></i> Update</a>
                      <div class="row justify-content-center">
                          <div class="col-md-8">
                              <h2 class="text-center py-5">{{$lesson->title}}</h2>

                              <p>{{$lesson->content}}</p>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
