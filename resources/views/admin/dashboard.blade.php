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
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <h2 class="card-title text-white text-oswald"><strong>{{$course_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Course{{$course_total > 1 ? 's' : ''}}</h2>
                    <a href="{{route('admin.course.index')}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <h2 class="card-title text-white text-oswald"><strong>{{$instructor_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Instructor{{$instructor_total > 1 ? 's' : ''}}</h2>
                    <a href="{{route('admin.instructor.index')}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <h2 class="card-title text-white text-oswald"><strong>{{$student_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Student{{$student_total > 1 ? 's' : ''}}</h2>
                    <a href="{{route('admin.student.index')}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
</div>
@endsection
