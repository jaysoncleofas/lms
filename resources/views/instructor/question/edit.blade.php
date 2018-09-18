@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald">{{$course->name}}</h3>
            <h4 class="text-oswald">Quiz / {{$quiz->title}}</h4>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-xl-9 col-md-9 mb-4">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Update Question</h3>
                <a href="{{route('instructor.question.index', [$course->id, $quiz->id])}}" class="btn btn-primary">Questions</a>
            </div>

            <form class="" action="{{route('instructor.question.update', [$course->id, $quiz->id, $question->id])}}"
                method="post" enctype="multipart/form-data">
                @csrf {{method_field('PUT')}}

                <div class="md-form">
                    <input type="text" name="question" id="question" value="{{$question->question}}" class="form-control {{$errors->has('question') ? 'is-invalid' : ''}}">
                    <label for="question">Question</label>
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
                            <input class="file-path" type="text" name="image" placeholder="Upload question image" readonly>
                        </div>
                    </div>

                    @if ($errors->has('image'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="text" name="correct" id="correct" value="{{$question->correct}}" class="form-control {{$errors->has('correct') ? 'is-invalid' : ''}}">
                    <label for="correct">Correct answer</label>
                    @if ($errors->has('correct'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('correct') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="text" name="option_one" id="option_one" value="{{$question->option_one}}" class="form-control">
                    <label for="option_one">Option</label>
                </div>

                <div class="md-form">
                    <input type="text" name="option_two" id="option_two" value="{{$question->option_two}}" class="form-control">
                    <label for="option_two">Option</label>
                </div>

                <div class="md-form">
                    <input type="text" name="option_three" id="option_three" value="{{$question->option_three}}" class="form-control">
                    <label for="option_three">Option</label>
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Update</button>
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
        } else {
            preview.src = "{{$question->question_image ? asset('storage/images/'.$question->question_image) : ''}}";
        }

    }

    previewFile(); //calls the function named previewFile()

</script>
@endsection
