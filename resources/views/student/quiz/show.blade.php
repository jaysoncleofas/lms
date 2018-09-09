@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('student.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <span class="breadcrumb-item active">Section</span>
                    <span class="breadcrumb-item active">{{$section->name}}</span>
                    <span class="breadcrumb-item active">Lesson</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            
                @foreach ($quiz->questions as $question)
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <h2 class="text-center text-oswald py-4">{{$question->question}}</h2>

                                        @foreach ($temp as $item)
                                            {{$item}} <br>
                                        @endforeach
                                        {{-- {{$temp}} --}}
                                       {{-- {{ json_decode($temp)}} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            
        </div>
    </div>
@endsection
