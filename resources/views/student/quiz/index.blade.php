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
        <div class="col-lg-8 col-sm-8">
            <p class="text-italize text-info"> <i class="fa fa-info"></i> When you take a quiz, time limit will start, when time limit expire unanswered questions will be automaticaly submitted even if you leave the quiz area.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5 pb-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
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
                            <td>
                                {{$quiz->startDate ? $quiz->startDate->toFormattedDateString() : ''}}
                            </td>
                            <td>
                                {{ $quiz->expireDate ? $quiz->expireDate->toFormattedDateString() : ''}}
                            </td>
                            <td><h4 class="text-oswald {{$quiz->takeQuiz ? 'green-text' : 'red-text'}}">{{$quiz->checktakes($section->id)->result ?? ''}}/{{count($quiz->questions)}}</h4></td>
                            <td>{{$quiz->timeLimit ?? 0}} minutes</td>
                            {{-- <td>{{$quiz->takes()->result ?? ''}}/{{count($quiz->questions)}}</td> --}}
                            <td>
                                @if ($quiz->checktakes($section->id))
                                    <p class="green-text"><i class="fa fa-check"></i></p>
                                @elseif(Carbon\Carbon::parse($quiz->startDate)->isFuture())
                                    <p class="red-text">Not Yet Available</p>
                                @elseif(Carbon\Carbon::parse($quiz->expireDate)->isPast())
                                    <p class="red-text">Expired</p>
                                @elseif(count($quiz->questions) == 0)
                                <p class="red-text">Unavailable</p>
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
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
