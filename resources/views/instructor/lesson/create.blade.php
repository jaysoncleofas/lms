@extends('layouts.app')

@section('styles')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fwl1zems9tvf6ysxti5p5zrr86dawn4f0zdyzwoel3rjh9ok"></script>
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <script>
        tinymce.init({ 
            selector:'textarea' 
        });
    </script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-xl-9 col-md-9 mb-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Add Assignment</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{route('instructor.lesson.store', $course->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
        
                        <div class="md-form">
                            <input type="text" name="title" id="title" value="{{old('title')}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                            <label for="title">Title <span class="red-asterisk">*</span></label>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="md-form">
                                    <p class="select2Label mb-0">Upload file <span class="red-asterisk">*</span></p>
                                    <span class="grey-text">File type supported: pdf, doc, ppt, xls, docx, pptx, xlsx, rar, zip, max:10MB</span>
                                    <div class="file-field">
                                        <div class="btn btn-primary btn-md float-left ml-0">
                                            <span><i class="fa fa-file-upload"></i> Choose file</span>
                                            <input type="file" name="upload_file" value="{{ old('upload_file') }}">
                                        </div>
                                        <div class="file-path-wrapper pr-3">
                                            <input class="file-path {{$errors->has('upload_file') ? 'is-invalid' : ''}}" value="{{ old('upload_file') }}" type="text" name="upload_file" id="upload_file" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('upload_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('upload_file') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="md-form mb-3">
                            <p class="select2Label">Content <span class="red-asterisk">*</span></p>
                            <textarea name="content" id="content" class="md-textarea form-control pt-0 {{$errors->has('content') ? 'is-invalid' : ''}}" rows="8" cols="80">{{old('content')}}</textarea>
                            {{-- <label for="content">Content</label> --}}
                            @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="md-form">
                            <p class="mb-0 select2Label">Section <span class="red-asterisk">*</span></p>
                            <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" style="width:100% !important;">
                                @foreach ($sections as $section2)
                                <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('sections'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sections') }}</strong>
                                </span>
                            @endif
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="checkbox">Select all</label>
                            </div>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary float-right mt-5"><i class="fa fa-save"></i> Save</button>
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
    $('.multiple-select').select2().val({!!json_encode(old('sections')) !!}).trigger('change');

    $("#checkbox").on('click',function(){
        if($("#checkbox").is(':checked') ){
            $('.multiple-select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
        }else{
            $('.multiple-select').select2('destroy').find('option').prop('selected', false).end().select2();
        }
    });
</script>
@endsection
