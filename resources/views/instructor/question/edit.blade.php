@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
        </div>
        <div>
            <a href="{{route('instructor.question.index', [$course->id, $quiz->id])}}" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-11 col-md-12 mb-4">
            <div class="card mt-3">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Quiz: {{ $quiz->title }} | Update {{ !$quiz->isCode ? 'Question' : 'Item' }}</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{route('instructor.question.update', [$course->id, $quiz->id, $question->id])}}"
                        method="post" enctype="multipart/form-data">
                        @csrf {{method_field('PUT')}}

                        @if (!$quiz->isCode)
                            <div class="form-group mb-3">
                                <p class="select2Label">Question <span class="red-asterisk">*</span></p>
                                <textarea type="text" id="question" name="question" class="form-control rounded-0 {{$errors->has('question') ? 'is-invalid' : ''}}" rows="3">{{ $question->question }}</textarea>
                                @if ($errors->has('question'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('question') }}</strong>
                                </span>
                                @endif
                            </div>
                        @else 
                            <div class="form-group mb-3">
                                <p class="select2Label">Item <span class="red-asterisk">*</span></p>
                                <textarea type="text" id="item" name="item" class="form-control rounded-0 {{$errors->has('item') ? 'is-invalid' : ''}}" rows="3">{{ $question->question }}</textarea>
                                @if ($errors->has('item'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('item') }}</strong>
                                </span>
                                @endif
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="md-form mt-0">
                                    <div class="file-field">
                                        <div class="btn btn-primary btn-md float-left ml-0">
                                            <span><i class="fa fa-file-image"></i> Upload image</span>
                                            <input type="file" name="question_image" onchange="previewFile()">
                                        </div>
                                    </div>
                                    
                                    @if ($errors->has('question_image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question_image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($question->question_image)
                            <img id="img-announcement" class="img-preview z-depth-1" style="height:500px;width:100%;object-fit:cover;margin-bottom:2rem;";>
                        @else
                            <img id="img-announcement" class="img-preview z-depth-1">
                        @endif

                        @if (!$quiz->isCode)
                            <div class="md-form mt-0">
                                <input type="text" name="correct" id="correct" value="{{$question->correct}}" class="form-control {{$errors->has('correct') ? 'is-invalid' : ''}}">
                                <label for="correct">Correct answer <span class="red-asterisk">*</span></label>
                                @if ($errors->has('correct'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correct') }}</strong>
                                </span>
                                @endif
                            </div>
                            <span>For identification type, leave the choices empty</span>
                            <div class="md-form">
                                <input type="text" name="option_one" id="option_one" value="{{$question->option_one}}" class="form-control">
                                <label for="option_one">Choice 1</label>
                            </div>
            
                            <div class="md-form">
                                <input type="text" name="option_two" id="option_two" value="{{$question->option_two}}" class="form-control">
                                <label for="option_two">Choice 2</label>
                            </div>
            
                            <div class="md-form">
                                <input type="text" name="option_three" id="option_three" value="{{$question->option_three}}" class="form-control">
                                <label for="option_three">Choice 3</label>
                            </div>
                        @endif
        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-pencil-alt"></i> Update</button>
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
    function previewFile() {
        var preview = document.querySelector('.img-preview'); //selects the query named img
        var file = document.querySelector('input[type=file]').files[0]; //sames as here
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            document.getElementById('img-announcement').style.height = "500px";
            document.getElementById('img-announcement').style.width = "100%";
            document.getElementById('img-announcement').style.objectFit = "cover";
            document.getElementById('img-announcement').style.marginBottom = "2rem";
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            preview.src = "{{$question->question_image ? asset('storage/images/'.$question->question_image) : ''}}";
        }

    }

    previewFile(); //calls the function named previewFile()

</script>
@endsection
