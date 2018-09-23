@extends('layouts.app')

{{-- @section('styles')
    <style>
        pre{
            background: grey;
        }
    </style>
@endsection --}}

@section('content')
    <div class="container-fluid">

            <div class="row px-3 d-flex justify-content-between align-items-center">
                    <h3 class="text-oswald">{{$course->name}} / Assignment</h3>
                    <a href="{{route('instructor.assignment.index', $course->id)}}" class="btn btn-danger">Back</a>
                </div>

        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card">
                  <div class="card-body">
                      <div class="row mx-3 d-flex justify-content-between align-items-center">

                          @if (count($assignment->sections) > 0)
                              <div>
                                    Assignment for
                                    @foreach ($assignment->sections as $value)
                                        <span class="breadcrumb-item active">{{$value->name}}</span>
                                    @endforeach
                              </div>
                          @endif
                          <a href="{{route('instructor.assignment.edit', [$course->id, $assignment->id])}}" class="pull-right"><i class="fa fa-pencil"></i> Update</a>
                      </div>
                      <div class="row justify-content-center">
                          <div class="col-md-11">
                              <h2 class="text-center py-5 text-oswald">{{$assignment->title}}</h2>

                              <p>{!! $assignment->content !!}</p>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
