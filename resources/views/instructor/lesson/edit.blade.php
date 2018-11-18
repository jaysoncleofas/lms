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
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-xl-9 col-md-9 mb-4">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Update Lesson</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{route('instructor.lesson.update', [$course->id, $lesson->id])}}" method="post"
                        enctype="multipart/form-data">
                        @csrf {{method_field('PUT')}}
        
                        <div class="md-form">
                            <input type="text" id="title" name="title" value="{{$lesson->title}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
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
                                    {{-- <span class="grey-text">File type supported: pdf, doc, ppt, xls, docx, pptx, xlsx, rar, zip, max:10MB</span> --}}
                                    <div class="file-field">
                                        <div class="btn btn-primary float-left ml-0 btn-md">
                                            <span><i class="fa fa-file"></i> Choose file</span>
                                            <input type="file" name="upload_file">
                                        </div>
                                        <div class="file-path-wrapper pr-3">
                                            <input class="file-path" type="text" name="upload_file" id="upload_file" placeholder="File type supported: pdf, doc, ppt, xls, docx, pptx, xlsx, rar, zip, max:10MB" value="{{substr($lesson->upload_file, 20)}}" readonly>
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

                        <div class="md-form">
                            <p class="select2Label">Content <span class="red-asterisk">*</span></p>
                            <textarea name="content" id="content" class="md-textarea form-control {{$errors->has('content') ? 'is-invalid' : ''}}" rows="8" cols="80">{{$lesson->description}}</textarea>
                            @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <p class="mb-0 mt-3 select2Label">Assign Section <span class="red-asterisk">*</span></p>
                        <div class="md-form mt-0">
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
                                <label class="form-check-label" for="checkbox">All Section</label>
                            </div>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary float-right mt-5"><i class="fa fa-pencil"></i> Update</button>
                    </form>
                </div>
            </div>
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

    $("#checkbox").on('click',function(){
        if($("#checkbox").is(':checked') ){
            $('.multiple-select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
        }else{
            $('.multiple-select').select2('destroy').find('option').prop('selected', false).end().select2();
        }
    });
</script>
@endsection
