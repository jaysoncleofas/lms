@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-lg-5">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade cascading-admin-card">
                    <div class="admin-up">
                        <i class="fa fa-book primary-color"></i>
                        <div class="data">
                            <p>Courses</p>
                            <h3 class="font-weight-bold dark-grey-text">{{$course_total}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{-- <p class="card-text">Better than last week (25%)</p> --}}
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-cascade cascading-admin-card">
                    <div class="admin-up">
                        <i class="fa fa-line-chart warning-color"></i>
                        <div class="data">
                            <p>Instructors</p>
                            <h3 class="font-weight-bold dark-grey-text">{{$instructor_total}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress">
                            <div class="progress-bar grey darken-2" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{-- <p class="card-text">Worse than last week (25%)</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
