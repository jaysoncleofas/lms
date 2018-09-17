@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-md-6">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Update Course</h3>
                <a href="{{route('admin.course.index')}}" class="btn btn-danger">Back</a>
            </div>

            <form action="{{route('admin.course.update', $course->id)}}" method="post">
                {{ csrf_field() }} {{method_field('PUT')}}

                <div class="md-form">
                    <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                        value="{{$course->name}}">
                    <label>Course Name</label>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="text" name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"
                        value="{{$course->code}}">
                    <label>Course code</label>
                    @if ($errors->has('code'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <textarea type="text" name="description" class="md-textarea form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                        rows="3">{{$course->description}}</textarea>
                    <label>Description</label>
                    @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>

                <p>Assign Instructors</p>
                <div class="md-form">
                    <select class="multiple-select form-control" multiple="multiple" name="instructors[]" required
                        style="width:100% !important;">
                        @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->firstName.' '.$instructor->lastName }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode($course - > users() - > allRelatedIds()) !!
    }).trigger('change');
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });

</script>
@endsection
