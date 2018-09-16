@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-xl-6 col-md-6">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Add Course</h3>
                <a href="{{route('admin.course.index')}}" class="btn btn-danger btn-sm">Back</a>
            </div>
            <form action="{{route('admin.course.store')}}" method="post">
                {{ csrf_field() }}

                <div class="md-form">
                    <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                        value="{{old('name')}}">
                    <label>Course Name</label>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="text" name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"
                        value="{{old('code')}}">
                    <label>Course code</label>
                    @if ($errors->has('code'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <textarea type="text" name="description" class="md-textarea form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                        rows="3">{{old('description')}}</textarea>
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
                        <option value="{{ $instructor->id }}" {{ $instructor->id === old('instructors') ? 'selected' : ''  }}>{{ $instructor->firstName.' '.$instructor->lastName }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-4 btn-sm">Save</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode(old('instructors')) !!}).trigger('change');
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });

</script>
@endsection
