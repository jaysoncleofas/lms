@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->quizzes)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Quiz{{count($section->quizzes) > 1 ? 'zes' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Quiz</th>
                        {{-- <th>Questions</th> --}}
                        <th>Result</th>
                        <th>Time limit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->quizzes as $key => $quiz)
                    <tr>
                        <th>{{$key+1}}</th>
                        <td><a href="">{{$quiz->title}}</a></td>
                        {{-- <td>{{count($quiz->questions)}}</td> --}}
                        <td><h4 class="text-oswald">{{$quiz->takes($section->id)->result ?? ''}}/{{count($quiz->questions)}}</h4></td>
                        <td>{{$quiz->timeLimit ?? 0}} minutes</td>
                        {{-- <td>{{$quiz->takes()->result ?? ''}}/{{count($quiz->questions)}}</td> --}}
                        <td>
                            @if ($quiz->checktakes($section->id))
                                <p class="green-text"><i class="fa fa-check"></i></p>
                            @elseif(count($quiz->questions) == 0)

                            <p class="red-text">unavailable</p>
                            @else
                            <a class="blue-text" href="{{route('student.quiz.show', [$course->id, $section->id, $quiz->id])}}">Take</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
