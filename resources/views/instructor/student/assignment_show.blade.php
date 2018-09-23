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
        <div class="row px-3 d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
                    <h4 class="text-oswald">Submitted Assignment</h4>
                </div>
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
                </div>
            </div>

    <div class="row mt-5">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-oswald mb-5 text-center">{{$assignment->title}}</h2>  
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8">
                            {!! $assignment->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-oswald mb-5 text-center">Assignment of: {{$submit->user->name()}}</h2>  
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-8">
                                {!! $submit->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
 
@section('script')
    @include('partials.notification')
@endsection