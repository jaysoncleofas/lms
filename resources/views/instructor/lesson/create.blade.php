@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-xl-9 col-md-9 mb-4">

            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Add Lesson</h3>
                <a href="{{route('instructor.lesson.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>

            <form class="" action="{{route('instructor.lesson.store', $course->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="md-form">
                    <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                    <label for="title">Title</label>
                    @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form mb-3">
                    <textarea name="description" id="description" class="md-textarea form-control pt-0 {{$errors->has('description') ? 'is-invalid' : ''}}"
                        rows="8" cols="80">{{old('title')}}</textarea>
                    <label for="description">Description</label>
                    @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

                <p class="mb-0">Assign Section</p>
                <div class="md-form mt-0">
                    <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" required style="width:100% !important;">
                        @foreach ($sections as $section2)
                        <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md-form">
                    <span class="grey-text">File type supported: pdf, doc, ppt, xls, docx, pptx, xlsx, rar, zip</span>
                    <div class="file-field">
                        <div class="btn btn-primary float-left">
                            <span>Choose file</span>
                            <input type="file" name="upload_file">
                        </div>
                        <div class="file-path-wrapper pr-3">
                            <input class="file-path {{$errors->has('upload_file') ? 'is-invalid' : ''}}" type="text"
                                name="upload_file" id="upload_file" placeholder="Upload upload_file" readonly>
                        </div>
                    </div>

                    @if ($errors->has('upload_file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('upload_file') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-5">Save</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode(old('sections')) !!}).trigger('change');

</script>
@endsection
