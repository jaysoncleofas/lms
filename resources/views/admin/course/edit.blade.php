@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald font-weight-bold">Update Course</h3>
                {{-- <a href="{{route('admin.course.index')}}" class="btn btn-light mr-0"><i class="fa fa-table"></i> TAble list</a> --}}
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form action="{{route('admin.course.update', $course->id)}}" method="post">
                        {{ csrf_field() }} {{method_field('PUT')}}
        
                        <div class="md-form">
                            <input type="text" id="name" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                value="{{$course->name}}">
                            <label for="name">Course Name <span class="red-asterisk">*</span></label>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="md-form">
                            <input type="text" name="code" id="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}"
                                value="{{$course->code}}">
                            <label for="code">Course code</label>
                            @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="form-group">
                            <label class="select2Label">Description</label>
                            <textarea type="text" name="description" rows="5" id="description" class="form-control rounded-0 {{$errors->has('description') ? 'is-invalid' : ''}}">{{$course->description}}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <p class="mb-0 mt-3 select2Label">Assign Instructors</p>
                        <div class="md-form mt-0">
                            <select class="multiple-select form-control" multiple="multiple" id="instructors" name="instructors[]" required
                                style="width:100% !important;">
                                @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->firstName.' '.$instructor->lastName }}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-pencil-alt"></i> Update</button>
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
    $('.multiple-select').select2().val({!!json_encode($course->users()->allRelatedIds())!!}).trigger('change');
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });

</script>
@endsection
