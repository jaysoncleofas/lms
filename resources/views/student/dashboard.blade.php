@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">Courses</h3>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($user->sections as $section)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-oswald"><a href="{{route('student.announcement', [$section->course->id, $section->id])}}">{{$section->course->name}}</a></h4>
                    <hr>
                    <p class="card-text">
                            {{ substr(strip_tags($section->course->description), 0, 200) }}{{ strlen($section->course->description) > 200 ? "..." : "" }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
