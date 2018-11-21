@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>{{ $course->name }}</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-4 mb-3">
                <div class="card">
                    <div class="text-white blue text-center py-4 px-4">
                        <i class="fa fa-save fa-3x tiles-left-icon"></i> 
                        <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($assignment->pass)) }}</strong></h2>
                        <h2 class="text-uppercase text-white text-oswald">Submitted{{count($assignment->pass) > 1 ? 's' : ''}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-2">
        <div class="row mt-0">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>{{ $assignment->isCode ? "Code " : '' }}Assignment: {{$assignment->title}}</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body pb-0">
                        <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Section</th>
                                    <th>Student</th>
                                    <th>Date Submitted</th>
                                    <th>Grade</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignment->pass as $passes)
                                    <tr>
                                        <td>{{$passes->section->name}}</td>
                                        <td><a class="blue-text" href="{{route('instructor.student.show', [$course->id, $passes->section->id, $passes->user->id])}}">{{$passes->user->name()}}</a></td>
                                        <td>{{$passes->created_at->toDayDateTimeString()}}</td>
                                        <td>{{ $passes->grade }}</td>
                                        <td><a href="{{route('instructor.assignment.submit', [$course->id, $assignment->id, $passes->section->id, $passes->id ])}}" class="blue-text">View</a></td>
                                        {{-- /course/{course}/assignment/{assignment}/section/{section}/submit/{submit} --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/addons/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                scrollX: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                },
                order:[]
            });
        });
    </script>
@endsection