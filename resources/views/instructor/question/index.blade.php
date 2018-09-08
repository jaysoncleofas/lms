@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <nav class="breadcrumb">
                  <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">Course</a>
                  <span class="breadcrumb-item active">{{$course->name}}</span>
                  <a class="breadcrumb-item" href="{{route('instructor.quiz.index', $course->id)}}">Quiz</a>
                  <span class="breadcrumb-item active">{{$quiz->title}}</span>
                  <span class="breadcrumb-item active">Question</span>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Question list</a>
                        <div>
                            <a href="{{route('instructor.question.create', [$course->id, $quiz->id])}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <td>Question</td>
                                        <td>Image</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr>

                                            <td>{{$question->question}}</td>
                                            <td> <img src="{{asset('storage/images/'.$question->question_image)}}" class="img-fluid" style="height:50px;" alt=""> </td>
                                            <td>
                                                <a href="{{route('instructor.question.edit', [$course->id, $quiz->id, $question->id])}}" class="blue-text">Update</a> |
                                                <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this question?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$question->id}}').submit();
                                                          }">
                                                    Delete
                                                </a>
                                                <form id="delete-instructor-form-{{$question->id}}" action="{{ route('instructor.question.destroy', [$course->id, $quiz->id, $question->id]) }}" method="post">
                                                  @csrf {{method_field('DELETE')}}

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('Datatables/datatables.min.js') }}"></script>
    @include('partials.notification')
    <script>
    $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
