@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row px-3 d-flex justify-content-between align-items-center">
            <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
        </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                      <div class="row mx-5 d-flex justify-content-between align-items-center">
                          @if (count($assignment->sections) > 0)
                              <div>
                                    Assignment for
                                    @foreach ($assignment->sections as $value)
                                        <span class="breadcrumb-item active">{{$value->name}}</span>
                                    @endforeach
                              </div>
                          @endif
                          <a href="{{route('instructor.assignment.edit', [$course->id, $assignment->id])}}" class="pull-right"><i class="fa fa-pencil-alt"></i> Update</a>
                      </div>
                      <div class="row justify-content-center mb-5">
                          <div class="col-md-11">
                              <h2 class="text-center py-3 text-oswald">{{$assignment->title}}</h2>

                              <p>{!! $assignment->content !!}</p>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12">
                <h4>Submitted Assignment{{count($assignment->pass) > 1 ? 's' : ''}}</h4>
                <div class="card mt-3">
                    <div class="card-body pb-0">
                        <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Section <i class="fa fa-sort float-right" aria-hidden="true"></i></th>
                                    <th>Student</th>
                                    <th>Date Submitted</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignment->pass as $passes)
                                    <tr>
                                        <td>{{$passes->section->name}}</td>
                                        <td><a class="blue-text" href="{{route('instructor.student.show', [$course->id, $passes->section->id, $passes->user->id])}}">{{$passes->user->name()}}</a></td>
                                        <td>{{$passes->created_at->toDayDateTimeString()}}</td>
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
    @include('partials.notification')
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