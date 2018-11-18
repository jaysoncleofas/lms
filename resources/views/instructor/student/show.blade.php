@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div>
                <div class="post-prev-title">
                    <h3>{{ $course->name }}</h3>
                </div>
                <div class="post-prev-info mb-0">
                    {{ $section->name }}
                </div>
            </div>
            <div>
                <a href="{{ route('instructor.student.index', [$course->id, $section->id]) }}" class="btn btn-light my-0 mr-0"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
    <hr class="mt-3">
    <div class="row">
        <div class="col-md-2 col-sm-4 text-center">
            <img src="{{ $student->avatar ? asset('storage/avatars/'.$student->avatar) : asset('images/profile_pic.png')}}" class="img-fluid rounded-circle z-depth-1" style="height:100px;width:100px;object-fit:cover;" alt="">
        </div>
        <div class="col-md-5 col-sm-8 instructor-des">
            <p><b>Name:</b> {{ $student->lastFirstName() }} <br>
            <b>Email-Address:</b> {{ $student->email }} <br>   
            <b>Username:</b> {{ $student->username }} 
            @if ($student->mobileNumber)
                <br><b>Mobile Number:</b> {{ $student->mobileNumber }}
            @endif
            </p>
        </div>    
    </div>
    <hr class="mb-2">
    <div class="row mt-0">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Quiz{{count($quizzes) > 1 ? 'zes' : ''}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5">
            <div class="table-responsive">
                <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
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
                            <td>{{$key+1}}.</td>
                            <td>{{$quiz->title}}</td>
                            <td>
                                @if($quiz->takes($section->id, $student->id))
                                    @if ($quiz->isCode)
                                        @if ($quiz->takes($section->id, $student->id)->result)
                                            <h4 class="text-oswald {{ $quiz->takes($section->id, $student->id)->result == 0 ? 'red-text' : 'green-text' }}">
                                                {{ $quiz->takes($section->id, $student->id)->result }}
                                            </h4>
                                        @else
                                            No result yet
                                        @endif
                                    @else
                                        <h4 class="text-oswald {{ $quiz->takes($section->id, $student->id)->result <= 0 ? 'red-text' : 'green-text' }}">
                                            {{$quiz->takes($section->id, $student->id)->result}}/{{count($quiz->questions)}}
                                        </h4>
                                    @endif
                                @else 
                                    <p class="red-text">No Quiz</p>
                                @endif 
                            </td>
                            <td>
                                {{$quiz->takes($section->id, $student->id) ? $quiz->takes($section->id, $student->id)->created_at->toDayDateTimeString() : ''}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr class="mb-2">
    <div class="row mt-0">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Assignment{{count($assignments) > 1 ? 's' : ''}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-5">
            <div class="table-responsive">
                <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
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
                            <td>{{$key+1}}.</td>
                            <td>{{$assignment->title}}</td>
                            <td>
                                @if ($assignment->passes($section->id, $student->id))
                                    @if ($assignment->passes($section->id, $student->id)->grade)
                                        <h4 class="text-oswald {{ $assignment->passes($section->id, $student->id)->grade == 0 ? 'red-text' : 'green-text' }}">
                                                {{ $assignment->passes($section->id, $student->id)->grade }}
                                        </h4>
                                    @else 
                                        No result yet
                                    @endif
                                @else
                                    <p class="red-text">No Assignment</p>
                                @endif
                            </td>
                            <td>
                                {{$assignment->passes($section->id, $student->id) ? $assignment->passes($section->id, $student->id)->created_at->toDayDateTimeString() : ''}}
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
