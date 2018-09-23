@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald">{{$course->name}}</h3>
            <h4 class="text-oswald">Section / {{$section->name}}</h4>
        </div>
        <div>
            <a href="{{route('instructor.student.index', [$course->id, $section->id])}}" class="btn btn-danger">Back</a>
        </div>
    </div>

    <div class="row mt-lg-3 justify-content-center">
        <h2 class="text-oswald text-capitalize">{{$student->firstName}} {{$student->lastName}}</h2>
    </div>

    <div class="row mt-5">
        <div class="col-xl-12 col-md-12 mb-5">
            <h4 class="text-oswald">Quiz{{count($quizzes) > 1 ? 'zes' : ''}}</h4>
            <div class="table-responsive">
                <table id="example" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz</th>
                            <th>Result</th>
                            <th>Date taken</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quizzes as $key => $quiz)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$quiz->title}}</td>
                            <td>
                                <h4 class="text-oswald {{$quiz->takeQuiz ? 'green-text' : 'red-text'}}">
                                    {{$quiz->takes($section->id, $student->id)->result ?? ''}}/{{count($quiz->questions)}}
                                </h4>
                            </td>
                            <td>
                                {{$quiz->takeQuiz ? $quiz->takeQuiz->created_at->toDayDateTimeString() : ''}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="row mt-5">
            <div class="col-xl-12 col-md-12 mb-5">
                <h4 class="text-oswald">Assignment{{count($assignments) > 1 ? 's' : ''}}</h4>
                <div class="table-responsive">
                        <table id="example" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Assignment</th>
                                        <th>Result</th>
                                        <th>Date Submitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignments as $key => $assignment)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$assignment->title}}</td>
                                        <td>
                                            @if ($assignment->passAss)
                                                <p class="green-text">Completed</p>
                                            @else
                                                    <p class="red-text">No Assignment</p>
                                            @endif
                                        </td>
                                        <td>{{ $assignment->passAss ? $assignment->passAss->created_at->toDayDateTimeString() : ''}}</td>
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
