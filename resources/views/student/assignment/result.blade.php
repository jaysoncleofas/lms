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
    {{-- <div class="row mt-5">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                        <ul class="nav md-pills pills-primary nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#panel5" role="tab">
                                        Assignment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#panel6" role="tab">My Assignment</a>
                                </li>
                            </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Panel 1-->
                        <div class="tab-pane fade in show active" id="panel5" role="tabpanel">
                            <div class="row justify-content-between d-flex">
                                <h2 class="text-oswald mb-5">{{$assignment->title}}</h2>
                                <div>
                                    <p class="mb-5">
                                        <i class="fa fa-clock-o"></i> {{ $assignment->startDate->toFormattedDateString() }}
                                        -
                                        <i class="fa fa-clock-o"></i> {{ $assignment->expireDate->toFormattedDateString() }}
                                    </p>
                                </div>
                            </div>
                            
                            {!! $assignment->content !!}
                        </div>
                        <!--/.Panel 1-->
                        <!--Panel 2-->
                        <div class="tab-pane fade" id="panel6" role="tabpanel">
                            <div class="row justify-content-between d-flex">
                                <h2 class="text-oswald">My Assignment</h2>
                                <p class="mb-5"><i class="fa fa-clock-o"></i> {{ $assignment->checkpasses($section->id)->created_at->toFormattedDateString() }}</p>
                            </div>
                                
                            {!! $assignment->checkpasses($section->id)->content !!}
                        </div>
                        <!--/.Panel 2-->
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    @endsection
 
@section('script')
    @include('partials.notification')
@endsection