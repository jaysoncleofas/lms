@extends('layouts.app')

@section('styles')
    <style>
        .card-body{
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">Dashboard</h3>
        </div>
    </div>
    <div class="row mt-lg-3">
        @foreach (Auth::user()->courses as $course)
        <div class="col-xl-4 col-md-6 mb-4">
                <div class="card">
                    <div class="view overlay text-white text-center">
                            <h2 class="text-uppercase card-title text-oswald mt-4">{{$course->name}}</h2>
                            <h4 class="black-text text-oswald">{{count($course->sections)}} Section{{count($course->sections) > 1 ? 's' : ''}}</h4>
                        <a href="{{route('instructor.section.index', $course->id)}}">
                            <div class="mask rgba-white-slight">
                            </div>
                        </a>
                    </div>
                    <div class="card-body">
                        <hr>
                        <p class="text-capitalize">{{ substr(strip_tags($course->description), 0, 200) }}{{ strlen($course->description) > 200 ? "..." : "" }}</p>
                    </div>
                </div>
{{-- 
            <div class="card">
                <div class="card-body">
                    <a href="{{route('instructor.section.index', $course->id)}}" class="black-text">
                        <h4 class="card-title text-oswald">{{$course->name}}</h4>
                    </a>
                    <hr>
                    <p class="card-text">
                            {{ substr(strip_tags($course->description), 0, 200) }}{{ strlen($course->description) > 200 ? "..." : "" }}
                    </p>
                </div>
                  <!-- Card footer -->
                <div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
                    <ul class="list-unstyled list-inline font-small">
                    <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>{{date('Y-m-d',strtotime($course->created_at))}}</li>
                    <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-graduation-cap pr-1"></i>{{count($course->sections)}}</a></li>
                    </ul>
                </div>
            </div> --}}
        </div>
        @endforeach

    </div>
</div>
@endsection
