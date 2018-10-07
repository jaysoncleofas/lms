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
        <div class="col-xl-8 col-md-8 mb-4">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Update Quiz</h3>
                <a href="{{route('instructor.quiz.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>
            <form class="" action="{{route('instructor.quiz.update', [$course->id, $quiz->id])}}" method="post">
                @csrf {{method_field('PUT')}}

                        <div class="md-form">
                            <input type="text" id="title" name="title" value="{{$quiz->title}}" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                            <label for="title">Title</label>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>

                    <div class="md-form">
                            <input type="number" id="minutes" name="minutes" value="{{$quiz->timeLimit}}" class="form-control {{$errors->has('minutes') ? 'is-invalid' : ''}}">
                            <label for="minutes">Minutes</label>
                            @if ($errors->has('minutes'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('minutes') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="md-form mb-3">
                            <input type="text" name="startDate" id="startDate" class="datepicker form-control" value="{{date('j F, Y',strtotime($quiz->startDate))}}">
                            <label for="startDate">Start Date</label>
                            @if ($errors->has('startDate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('startDate') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="md-form mb-3">
                            <input type="text" name="expireDate" id="expireDate" class="datepicker form-control" value="{{date('j F, Y',strtotime($quiz->expireDate))}}">
                            <label for="expireDate">Expire Date</label>
                            @if ($errors->has('expireDate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('expireDate') }}</strong>
                            </span>
                            @endif
                        </div>

                        <p class="mb-0 select2Label">Assign Section</p>
                        <div class="md-form mt-0">
                            <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" style="width:100% !important;">
                                @foreach ($sections as $section2)
                                <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="checkbox">Send to all</label>
                            </div>
                        </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode($quiz->sections()->allRelatedIds()) !!}).trigger('change');
    $("#checkbox").on('click',function(){
        if($("#checkbox").is(':checked') ){
            $('.multiple-select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
        }else{
            $('.multiple-select').select2('destroy').find('option').prop('selected', false).end().select2();
        }
    });
    $('.datepicker').pickadate({
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
    });
</script>
@endsection
