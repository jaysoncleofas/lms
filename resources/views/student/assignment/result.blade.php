@extends('layouts.app')

@section('styles')
    <style>
        .nav-tabs{
            background-color: white !important;
            color: black !important;
        }
        .nav-tabs .nav-link.active {
            color: black !important
        }
        .nav-tabs .nav-link {
            color: black !important
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <div class="post-prev-info mb-0">
                {{ $section->name }}
            </div>
            <hr class="mt-0">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h4 class="text-oswald">{{ $assignment->title }}</h4>
                            {!! $assignment->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10 mb-5">
                            <h4 class="text-oswald text-center py-3">My Assignment</h4>
                            {!! $assignment->checkpasses($section->id)->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection