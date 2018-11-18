@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <a href="{{ route('instructor.question.index', [$course->id, $quiz->id]) }}" class="btn btn-light my-0 mr-0"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-10 col-md-12 mb-3">
            <h3 class="text-oswald">Quiz: {{ $quiz->title }}</h3>
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Add Question</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{route('instructor.question.store', [$course->id, $quiz->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        @if (!$quiz->isCode)
                            <div class="form-group mb-3">
                                <p class="select2Label">Question <span class="red-asterisk">*</span></p>
                                <textarea type="text" id="question" name="question" class="form-control rounded-0 {{$errors->has('question') ? 'is-invalid' : ''}}" rows="3">{{old('question')}}</textarea>
                                @if ($errors->has('question'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('question') }}</strong>
                                </span>
                                @endif
                            </div>
                        @else 
                            <div class="form-group mb-3">
                                <p class="select2Label">Item <span class="red-asterisk">*</span></p>
                                <textarea type="text" id="item" name="item" class="form-control rounded-0 {{$errors->has('item') ? 'is-invalid' : ''}}" rows="3">{{old('item')}}</textarea>
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
                                            <input type="file" name="image" onchange="previewFile()">
                                        </div>
                                    </div>
                                    
                                    @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <img id="img-announcement" class="img-fluid img-preview z-depth-1">
                        
                        @if (!$quiz->isCode)
                            <div class="md-form mt-0">
                                <input type="text" name="correct" id="correct" value="{{old('correct')}}" class="form-control {{$errors->has('correct') ? 'is-invalid' : ''}}">
                                <label for="correct">Correct answer <span class="red-asterisk">*</span></label>
                                @if ($errors->has('correct'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('correct') }}</strong>
                                </span>
                                @endif
                            </div>
                            <span>For identification type, leave the choices empty</span>
                            <div class="md-form">
                                <input type="text" name="option_one" id="option_one" value="{{old('option_one')}}" class="form-control">
                                <label for="option_one">Choice 1</label>
                            </div>
            
                            <div class="md-form">
                                <input type="text" name="option_two" id="option_two" value="{{old('option_two')}}" class="form-control">
                                <label for="option_two">Choice 2</label>
                            </div>
            
                            <div class="md-form">
                                <input type="text" name="option_three" id="option_three" value="{{old('option_three')}}" class="form-control">
                                <label for="">Choice 3</label>
                            </div>
                        @endif

        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
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
        }

    }

    previewFile(); //calls the function named previewFile()

</script>
@endsection
