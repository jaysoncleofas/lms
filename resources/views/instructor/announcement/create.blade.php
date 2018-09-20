@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<style media="screen">
    .mdb-feed {
            margin: 0 !important
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-xl-6 col-md-6 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Post Announcement</h3>
                <a href="{{route('instructor.announcement.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>
            <form class="" action="{{route('instructor.announcement.store', $course->id)}}" method="post">
                {{ csrf_field() }}

                <div class="md-form mb-3">
                    <textarea type="text" id="message" name="message" class="form-control md-textarea {{$errors->has('message') ? 'is-invalid' : ''}}"
                        rows="3">{{old('message')}}</textarea>
                    <label for="message">Message</label>
                    @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                    @endif
                </div>

                <p class="mb-0">Select Section</p>
                <div class="md-form mt-0">
                    <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" required style="width:100% !important;">
                        @foreach ($sections as $section2)
                        <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary pull-right mt-5">Post</button>

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
