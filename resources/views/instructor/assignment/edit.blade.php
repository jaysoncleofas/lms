@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-xl-6 col-md-6 mb-4">
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
                        <input type="text" name="deadline" id="deadline" placeholder="Select date" class="datepicker form-control" value="{{date('j F, Y',strtotime($assignment->expireDate))}}">
                        <label for="deadline">Deadline</label>
                        @if ($errors->has('deadline'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('deadline') }}</strong>
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
