@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <nav class="breadcrumb">
                  <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">{{$course->name}}</a>
                  <a class="breadcrumb-item" href="{{route('instructor.lesson.index', $course->id)}}">Lessons</a>
                  <span class="breadcrumb-item active">Update</span>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                      <form class="" action="{{route('instructor.lesson.update', [$course->id, $lesson->id])}}" method="post">
                          @csrf {{method_field('PUT')}}
                          <div class="form-row">
                              <div class="col-md-6">
                                  <div class="md-form">
                                      <input type="text" name="title" value="{{$lesson->title}}" class="form-control">
                                      <label for="">Title</label>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <p>Assign Section</p>
                                  <div class="md-form">
                                       <select class="multiple-select form-control" multiple="multiple" name="sections[]" style="width:100% !important;">
                                          @foreach ($sections as $section2)
                                          <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                          @endforeach
                                       </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <textarea name="content" class="md-textarea form-control" rows="8" cols="80">{{$lesson->content}}</textarea>
                                      <label for="">Content</label>
                                  </div>
                              </div>
                          </div>
                          <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Update</button>
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
        $('.multiple-select').select2().val({!! json_encode($lesson->sections()->allRelatedIds()) !!}).trigger('change');
    </script>
@endsection
