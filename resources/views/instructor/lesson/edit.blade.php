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
                            <a class="white-text mx-3">Update Lesson</a>
                        <div>
                            <a href="{{route('instructor.lesson.index', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Back to Lesson list"><i class="fa fa-chevron-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form class="" action="{{route('instructor.lesson.update', [$course->id, $lesson->id])}}" method="post" enctype="multipart/form-data">
                          @csrf {{method_field('PUT')}}
                          <div class="form-row">
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <input type="text" name="title" value="{{$lesson->title}}" class="form-control">
                                      <label for="">Title</label>
                                  </div>
                              </div>
                              <div class="col-md-12 mt-3">
                                  <p class="mb-0">Assign Section</p>
                                  <div class="md-form mt-0">
                                       <select class="multiple-select form-control" multiple="multiple" name="sections[]" style="width:100% !important;">
                                          @foreach ($sections as $section2)
                                          <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                          @endforeach
                                       </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <textarea name="description" class="md-textarea form-control" rows="8" cols="80">{{$lesson->description}}</textarea>
                                      <label for="">Content</label>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                    <div class="md-form">
                                        <div class="file-field">
                                            <div class="btn btn-primary btn-sm float-left">
                                                <span>Choose file</span>
                                                <input type="file" name="upload_file">
                                            </div>
                                            <div class="file-path-wrapper pr-3">
                                                <input class="file-path" type="text" name="upload_file" placeholder="Upload upload_file" value="{{substr($lesson->upload_file, 20)}}" readonly>
                                            </div>
                                        </div>

                                        @if ($errors->has('upload_file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('upload_file') }}</strong>
                                            </span>
                                        @endif
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
