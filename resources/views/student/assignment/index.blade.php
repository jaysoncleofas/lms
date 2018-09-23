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
                    <h2 class="text-uppercase text-white text-oswald">Assignment{{count($section->assignments) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignment</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th>Date Submitted</th>
                            <th>Result</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section->assignments as $key => $assignment)
                        <tr>
                            <th>{{$key+1}}</th>
                            <td>{{$assignment->title}}</td>
                            <td>
                                {{$assignment->startDate ? $assignment->startDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                {{ $assignment->expireDate ? $assignment->expireDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                {{ $assignment->checkpasses($section->id) ? $assignment->checkpasses($section->id)->created_at->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                @if ($assignment->checkpasses($section->id))
                                    <p class="green-text">Completed</p>
                                @else 
                                    <p class="red-text">No Assignment</p>
                                @endif
                            </td>
                            <td>
                                @if ($assignment->checkpasses($section->id))
                                    <a href="{{route('student.pass.result_assignment', [$course->id, $section->id, $assignment->id, $assignment->pass($section->id, Auth::id())->id])}}" class="blue-text">View</a>
                                @elseif(Carbon\Carbon::parse($assignment->startDate)->isFuture())
                                    <p class="red-text">Not Yet Available</p>
                                @elseif(Carbon\Carbon::parse($assignment->expireDate)->isPast())
                                    <p class="red-text">Expired</p>
                                @else
                                    <a class="blue-text" href="{{route('student.assignment.show', [$course->id, $section->id, $assignment->id])}}">Submit</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
