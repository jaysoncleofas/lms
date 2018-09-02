@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <span class="breadcrumb-item active">Courses</span>
                </nav>
            </div>
        </div>
        <div class="row">
            @foreach (Auth::user()->courses as $course)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card card-cascade cascading-admin-card">
                        <div class="admin-up">
                            <i class="fa fa-book primary-color"></i>
                            <div class="data">
                                {{-- <p>{{$course->name}}</p> --}}
                                <h3 class="font-weight-bold">
                                    <a href="{{route('instructor.section.index', $course->id)}}" class="dark-grey-text">{{$course->name}}</a>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="card-text">{{$course->description}}</p>
                        </div>

                        <div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
                          <ul class="list-unstyled list-inline font-small">
                            <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>{{date('F j, Y',strtotime($course->created_at))}}</li>
                            {{-- <li class="list-inline-item pr-2"><a href="#" class="white-text"><i class="fa fa-users pr-1"></i>12</a></li> --}}
                          </ul>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
