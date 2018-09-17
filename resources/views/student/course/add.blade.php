@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <h3 class="text-oswald">Courses</h3>
            <a href="{{route('student.dashboard')}}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-center">
                    <form action="{{route('student.register.store', $section->section->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="sections" value="{{$section->section->id}}">
                        <h4 class="text-oswald">{{$section->course->name}} / {{$section->section->name}}</h4>
                        {{-- <p>{{$section->course->description}}</p> --}}
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
