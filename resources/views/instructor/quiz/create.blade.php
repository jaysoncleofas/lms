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
                <h3 class="text-oswald">Add Quiz</h3>
                <a href="{{route('instructor.quiz.index', $course->id)}}" class="btn btn-danger btn-sm">Back</a>
            </div>
            <form class="" action="{{route('instructor.quiz.store', $course->id)}}" method="post">
                @csrf

                <div class="md-form">
                    <input type="text" name="title" value="{{old('title')}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                    <label for="">Title</label>
                    @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="number" name="minutes" value="{{old('minutes')}}" class="form-control {{$errors->has('minutes') ? 'is-invalid' : ''}}">
                    <label for="">Minutes</label>
                    @if ($errors->has('minutes'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('minutes') }}</strong>
                    </span>
                    @endif
                </div>

                <p class="mb-0">Assign Section</p>
                <div class="md-form mt-0">
                    <select class="multiple-select form-control" multiple="multiple" name="sections[]" required style="width:100% !important;">
                        @foreach ($sections as $section2)
                        <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-5 btn-sm">Save</button>
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
