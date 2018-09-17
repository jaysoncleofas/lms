@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->assignments)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Assignments</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Assignment</th>
                        <th>Questions</th>
                        <th>Result</th>
                        <th>Deadline</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->assignments as $key => $assignment)
                    <tr>
                        <th>{{$key+1}}</th>
                        <td><a href="">{{$assignment->title}}</a></td>
                        <td>{{count($assignment->questions)}}</td>
                        <td>{{$assignment->takes()->result ?? ''}}</td>
                        <td>{{$assignment->expireDate ? date('F j, Y',strtotime($assignment->expireDate)) : ''}}</td>
                        <td>
                            @if ($assignment->checktakes())
                                <p class="green-text"><i class="fa fa-check"></i></p>
                            @elseif(count($assignment->questions) == 0)
                                <p class="red-text">Unavailable</p>
                            @elseif(Carbon\Carbon::parse($assignment->expireDate)->isPast())
                                <p class="red-text">Expired</p>
                            @else    
                                <a class="blue-text" href="{{route('student.assignment.show', [$course->id, $section->id, $assignment->id])}}">Take</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
