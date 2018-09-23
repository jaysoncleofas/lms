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
        <h3 class="text-oswald">{{$course->name}}</h3>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-xl-11 col-md-11 mb-4">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Update Assignment</h3>
                <a href="{{route('instructor.assignment.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>
            <form class="" action="{{route('instructor.assignment.update', [$course->id, $assignment->id])}}" method="post">
                @csrf {{method_field('PUT')}}

                <div class="md-form">
                    <input type="text" name="title" id="title" value="{{$assignment->title}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                    <label for="title">Title</label>
                    @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form mb-3">
                    <p>Content</p>
                    <textarea name="content" id="content" class="md-textarea form-control pt-0 {{$errors->has('content') ? 'is-invalid' : ''}}"
                        rows="15">{{ $assignment->content }}</textarea>
                    {{-- <label for="content">Description</label> --}}
                    @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <input type="text" name="startDate" id="startDate" class="datepicker form-control" value="{{date('j F, Y',strtotime($assignment->startDate))}}">
                            <label for="startDate">Start Date</label>
                            @if ($errors->has('startDate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('startDate') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-3">
                            <input type="text" name="expireDate" id="expireDate" class="datepicker form-control" value="{{date('j F, Y',strtotime($assignment->expireDate))}}">
                            <label for="expireDate">Expire Date</label>
                            @if ($errors->has('expireDate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expireDate') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <p class="mb-0">Assign Section</p>
                <div class="md-form mt-2">
                    <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" style="width:100% !important;">
                        @foreach ($sections as $section2)
                        <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" name="button" class="btn btn-primary pull-right mt-5">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode($assignment->sections()->allRelatedIds()) !!}).trigger('change');
    $('.datepicker').pickadate({
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
    });
</script>
@endsection
