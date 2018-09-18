@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">Dashboard</h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{$course_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Course{{$course_total > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{$instructor_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Instructor{{$instructor_total > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{$student_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Student{{$student_total > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-xl-3 col-md-6 mb-4">
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
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>

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
                    <div class="progress-bar grey darken-2" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
</div>
@endsection
