@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

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
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Add Lesson</a>
                        <div>
                            <a href="{{route('instructor.lesson.index', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Back to Lesson list"><i class="fa fa-chevron-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form class="" action="{{route('instructor.lesson.store', $course->id)}}" method="post">
                          @csrf
                          <div class="form-row">
                              <div class="col-md-6">
                                  <div class="md-form">
                                      <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                      <label for="">Title</label>
                                  </div>
                              </div>
                              <div class="col-md-6 mt-3">
                                  <p class="mb-0">Assign Section</p>
                                  <div class="md-form mt-0">
                                       <select class="multiple-select form-control" multiple="multiple" name="sections[]" required style="width:100% !important;">
                                          @foreach ($sections as $section2)
                                          <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                          @endforeach
                                       </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <textarea name="content" class="md-textarea form-control" rows="8" cols="80">{{old('title')}}</textarea>
                                      <label for="">Content</label>
                                  </div>
                              </div>
                          </div>
                          <button type="submit" name="button" class="btn btn-primary pull-right btn-sm mt-4">Save</button>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $('.multiple-select').select2();
    </script>
@endsection
