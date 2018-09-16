@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald">{{$course->name}}</h3>
            <h4 class="text-oswald">Assignment / {{$assignment->title}}</h4>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-xl-9 col-md-9 mb-4">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Add Question</h3>
                <a href="{{route('instructor.question.assignmentIndex', [$course->id, $assignment->id])}}" class="btn btn-primary btn-sm">Questions</a>
            </div>
            <form class="" action="{{route('instructor.question.assignmentStore', [$course->id, $assignment->id])}}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="md-form">
                    <input type="text" name="question" value="{{old('question')}}" class="form-control {{$errors->has('question') ? 'is-invalid' : ''}}">
                    <label for="">Question</label>
                    @if ($errors->has('question'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                    @endif
                </div>

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

                <div class="md-form">
                    <input type="text" name="correct" value="{{old('correct')}}" class="form-control {{$errors->has('correct') ? 'is-invalid' : ''}}">
                    <label for="">Correct answer</label>
                    @if ($errors->has('correct'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('correct') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="text" name="option_one" value="{{old('option_one')}}" class="form-control">
                    <label for="">Option</label>
                </div>

                <div class="md-form">
                    <input type="text" name="option_two" value="{{old('option_two')}}" class="form-control">
                    <label for="">Option</label>
                </div>

                <div class="md-form">
                    <input type="text" name="option_three" value="{{old('option_three')}}" class="form-control">
                    <label for="">Option</label>
                </div>

                <button type="submit" name="button" class="btn btn-primary btn-sm pull-right btn-sm mt-4">Save</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
<script>
    function previewFile() {
        var preview = document.querySelector('.img-preview'); //selects the query named img
        var file = document.querySelector('input[type=file]').files[0]; //sames as here
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        }

    }

    previewFile(); //calls the function named previewFile()

</script>
@endsection
