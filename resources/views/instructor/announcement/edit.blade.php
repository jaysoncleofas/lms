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
                <h3 class="text-oswald">Update Announcement</h3>
                <a href="{{route('instructor.announcement.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>
            <form class="" action="{{route('instructor.announcement.update', [$course->id, $announcement->id])}}"
                method="post">
                {{ csrf_field() }} {{method_field('PUT')}}
                <!-- Add comment -->
                <div class="md-form mb-3">
                    <textarea type="text" id="message" name="message" class="form-control md-textarea {{$errors->has('message') ? 'is-invalid' : ''}}"
                        rows="3">{{$announcement->message}}</textarea>
                    <label for="message">Message</label>
                    @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('message') }}</strong>
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

                    <button type="submit" class="btn btn-primary mt-5 pull-right">Update</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $('.multiple-select').select2();
    $('.multiple-select').select2().val({!!json_encode($announcement->sections()->allRelatedIds()) !!}).trigger('change');

</script>
@endsection
