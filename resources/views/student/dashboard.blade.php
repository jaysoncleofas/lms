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
            @foreach ($user->sections as $section)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="view overlay">
                            <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/food.jpg" alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                        <a href="{{route('student.announcement', [$section->course->id, $section->id])}}" class="btn-floating btn-action ml-auto mr-4 mdb-color lighten-3"><i class="fa fa-chevron-right pl-1"></i></a>
                        <div class="card-body">
                            <h4 class="card-title text-oswald">{{$section->course->name}}</h4>
                            <hr>
                            <p class="card-text">{{$section->course->description}}</p>
                        </div>
                        <div class="rounded-bottom mdb-color lighten-3 pl-3 pt-3">
                            <ul class="list-unstyled list-inline font-small">
                                <li class="list-inline-item pr-2 white-text"><i class="fa fa-clock-o pr-1"></i>{{$section->name}}</li>
                                <li class="list-inline-item"><a href="#" class="white-text"><i class="fa fa-twitter pr-1"> </i>5</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
