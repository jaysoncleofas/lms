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
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>

    {{-- <div class="row mt-5 justify-content-center">
        <div class="col-lg-4 col-sm-4 text-center">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="text-uppercase text-white text-oswald">Assignment Submitted</h2>
                </div>
            </div>
        </div>
    </div> --}}

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
                        <h2 class="text-oswald mb-5 text-center">My Assignment</h2>  
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-8">
                                {!! $assignment->checkpasses($section->id)->content !!}
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