@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-lg-4 col-sm-4 text-center">
            <h2 class="text-oswald">Assignment: {{$assignment->title}}</h2>
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{$take->result}}/{{count($assignment->questions)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Result</h2>
                </div>
            </div>
        </div>
    </div>
    @endsection
