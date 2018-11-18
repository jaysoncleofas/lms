@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Dashboard</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3 pr-3">
        <div class="col-xl-4 col-md-6 mb-3 pr-0">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-list fa-3x tiles-left-icon"></i>
                    <h2 class="card-title text-white text-oswald"><strong>{{$course_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Course{{$course_total > 1 ? 's' : ''}}</h2>
                    <a href="{{route('admin.course.index')}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3 pr-0">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-users fa-3x tiles-left-icon"></i>
                    <h2 class="card-title text-white text-oswald"><strong>{{$instructor_total}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Instructor{{$instructor_total > 1 ? 's' : ''}}</h2>
                    <a href="{{route('admin.instructor.index')}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-3 pr-0">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-graduation-cap fa-3x tiles-left-icon"></i>
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

    <div class="row mt-3 mb-5 pr-3">
        <div class="col-md-8 mb-3 pr-0">
            <div class="card-header" style="background:#3793cb;">
                <h5 class="text-oswald mb-0 white-text">Chart</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="doughnutChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 pr-0">
            <div class="list-group">
                <div class="list-group-item list-group-item-action active p-2">
                    <h5 class="text-oswald mb-0">New users</h5>
                </div>
                @forelse ($new_users as $user)
                    <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start p-2">
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-0"><strong>{{ $user->name() }}</strong></p>
                            <small>{{ $user->created_at->diffForHumans() }}</small>
                        </div>
                        <span class="text-capitalize">{{ $user->role }}</span>
                    </a>
                @empty
                    <p><i>No data available</i></p>
                @endforelse
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@section('script')

<script>
    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Lessons", "Quizzes", "Assignments"],
            datasets: [
                {
                    data: {!! json_encode($pie_data) !!},
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }
            ]
        },
        options: {
            responsive: true
        }
    });
</script>

@endsection
