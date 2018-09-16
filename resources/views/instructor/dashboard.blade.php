@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">Dashboard</h3>
        </div>
    </div>
    <div class="row mt-lg-3">
        @foreach (Auth::user()->courses as $course)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                {{-- <div class="view overlay">
                    <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/food.jpg" alt="Card image cap">
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div> --}}
                <div class="card-body">
                    <h4 class="card-title text-oswald">{{$course->name}}</h4>
                    <hr>
                    <p class="card-text">{{$course->description}}</p>
                    <hr>
                    <a href="{{route('instructor.section.index', $course->id)}}" class="btn-floating btn-action ml-auto mr-4 mdb-color lighten-3"><i
                            class="fa fa-chevron-right pl-1"></i></a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
