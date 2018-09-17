@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <h3 class="text-oswald">Courses / Sections</h3>
            <a data-toggle="modal" data-target="#basicExampleModal" class="btn btn-primary">Token</a>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($user->sections as $section)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-oswald"><a href="{{route('student.announcement', [$section->course->id, $section->id])}}">{{$section->course->name}} / {{$section->name}}</a></h4>
                    <hr>
                    <p class="card-text">
                        {{ substr(strip_tags($section->course->description), 0, 200) }}{{
                        strlen($section->course->description) > 200 ? "..." : "" }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register token</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('student.check_token')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="md-form">
                        <input type="text" name="token" id="token" class="form-control">
                        <label for="token">Token</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection