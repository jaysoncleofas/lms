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
                <h3 class="text-oswald">Update Lesson</h3>
                <a href="{{route('instructor.lesson.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>
            <form class="" action="{{route('instructor.lesson.update', [$course->id, $lesson->id])}}" method="post"
                enctype="multipart/form-data">
                @csrf {{method_field('PUT')}}

                <div class="md-form">
                    <input type="text" id="title" name="title" value="{{$lesson->title}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                    <label for="title">Title</label>
                    @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <textarea name="description" id="description" class="md-textarea form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                        rows="8" cols="80">{{$lesson->description}}</textarea>
                    <label for="description">Description</label>
                    @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

                <p class="mb-0">Assign Section</p>
                <div class="md-form mt-0">
                    <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" style="width:100% !important;">
                        @foreach ($sections as $section2)
                        <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md-form">
                    <div class="file-field">
                        <div class="btn btn-primary float-left">
                            <span>Choose file</span>
                            <input type="file" name="upload_file">
                        </div>
                        <div class="file-path-wrapper pr-3">
                            <input class="file-path" type="text" name="upload_file" id="upload_file" placeholder="Upload file" value="{{substr($lesson->upload_file, 20)}}"
                                readonly>
                        </div>
                    </div>
                    @if ($errors->has('upload_file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('upload_file') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-5">Update</button>
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
    $('.multiple-select').select2().val({!!json_encode($lesson->sections()->allRelatedIds()) !!}).trigger('change');

</script>
@endsection
