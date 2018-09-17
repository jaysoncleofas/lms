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
        <div class="col-xl-12 col-md-12 mb-4">
            <h4 class="text-oswald">Quizzes</h4>
            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Quiz</th>
                        <th>Result</th>
                        {{-- <th>Taken</th> --}}
                        {{-- <td>Action</td> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$quiz->title}}</td>
                        <td>{{$quiz->takes($section->id)->result ?? ''}}/{{count($quiz->questions)}}</td>
                        {{-- <td>{{$user->email}}</td> --}}
                        {{-- <td>
                            <a href="{{route('instructor.student.show', [$course->id, $section->id, $user->id])}}" class="blue-text">View</a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="row mt-5">
            <div class="col-xl-12 col-md-12 mb-4">
                <h4 class="text-oswald">Assignments</h4>
                <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignment</th>
                            <th>Result</th>
                            {{-- <th>Taken</th> --}}
                            {{-- <td>Action</td> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $key => $assignment)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$assignment->title}}</td>
                            <td>{{$assignment->takes($section->id)->result ?? ''}}/{{count($assignment->questions)}}</td>
                            {{-- <td>
                                {{date('F j, Y',strtotime($assignment->takes($section->id)->created_at ?? ''))}}
                            </td> --}}

                                {{-- {{$assignment->expireDate ? date('F j, Y',strtotime($assignment->expireDate)) : ''}} --}}
                            {{-- <td>{{$user->email}}</td> --}}
                            {{-- <td>
                                <a href="{{route('instructor.student.show', [$course->id, $section->id, $user->id])}}" class="blue-text">View</a>
                            </td> --}}
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
