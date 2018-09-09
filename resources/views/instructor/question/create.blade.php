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
                  <a class="breadcrumb-item" href="{{route('instructor.quiz.index', $course->id)}}">Quiz</a>
                  <span class="breadcrumb-item active">{{$quiz->title}}</span>
                  <a class="breadcrumb-item" href="{{route('instructor.question.index', [$course->id, $quiz->id])}}">Question</a>
              </nav>
          </div>
      </div>
        <div class="row justify-content-center mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Add Question</a>
                        <div>
                            <a href="{{route('instructor.assignment.index', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Back to Assignment list"><i class="fa fa-chevron-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                      <form class="" action="{{route('instructor.question.store', [$course->id, $quiz->id])}}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-row">
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <input type="text" name="question" value="{{old('question')}}" class="form-control {{$errors->has('question') ? 'is-invalid' : ''}}">
                                      <label for="">Question</label>
                                      @if ($errors->has('question'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('question') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <img class="img-fluid img-preview">
                                      <div class="file-field">
                                          <div class="btn btn-primary btn-sm float-left">
                                              <span>Choose file</span>
                                              <input type="file" name="image" onchange="previewFile()">
                                          </div>
                                          <div class="file-path-wrapper pr-3">
                                              <input class="file-path" type="text" placeholder="Upload question image" readonly>
                                          </div>
                                      </div>

                                      @if ($errors->has('image'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('image') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <input type="text" name="correct" value="{{old('correct')}}" class="form-control {{$errors->has('correct') ? 'is-invalid' : ''}}">
                                      <label for="">Correct answer</label>
                                      @if ($errors->has('correct'))
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $errors->first('correct') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <input type="text" name="option_one" value="{{old('option_one')}}" class="form-control">
                                      <label for="">Option</label>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <input type="text" name="option_two" value="{{old('option_two')}}" class="form-control">
                                      <label for="">Option</label>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="md-form">
                                      <input type="text" name="option_three" value="{{old('option_three')}}" class="form-control">
                                      <label for="">Option</label>
                                  </div>
                              </div>
                          </div>
                          <button type="submit" name="button" class="btn btn-primary btn-sm pull-right btn-sm mt-4">Save</button>
                      </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.notification')
<script>
function previewFile(){
    var preview = document.querySelector('.img-preview'); //selects the query named img
    var file    = document.querySelector('input[type=file]').files[0]; //sames as here
    var reader  = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
    }

}

previewFile();  //calls the function named previewFile()


</script>
@endsection
