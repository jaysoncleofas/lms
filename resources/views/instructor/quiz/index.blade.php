@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <nav class="breadcrumb">
                  <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">{{$course->name}}</a>
                  <span class="breadcrumb-item active">Quizzes</span>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Quiz table</a>
                        <div>
                            <a href="{{route('instructor.quiz.create', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <td>Title</td>
                                        <td>Sections</td>
                                        <td>Questions</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quizzes as $quiz)
                                        <tr>
                                            <td><a href="{{ route('instructor.quiz.show', [$course->id, $quiz->id]) }}" class="blue-text">{{$quiz->title}}</a></td>
                                            <td>
                                                @foreach ($quiz->sections as $section2)
                                                    {{$section2->name}},
                                                @endforeach
                                            </td>
                                            <td>
                                                10
                                            </td>
                                            <td>
                                                {{-- @if ($quiz->isActive == 1)
                                                    <a href="#" class="btn btn-sm btn-success" onclick="if(confirm('Are you sure you want to deactivate this quiz?')) {
                                                                event.preventDefault();
                                                                $('#deactivate-form-{{$quiz->id}}').submit();
                                                              }">
                                                              Active
                                                    </a>
                                                    <form id="deactivate-form-{{$quiz->id}}" action="{{ route('instructor.quiz.status', [$course->id, $quiz->id]) }}" method="post">
                                                      @csrf {{method_field('PUT')}}
                                                      <input type="hidden" name="status" value="0">
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to activate this quiz?')) {
                                                                event.preventDefault();
                                                                $('#activate-form-{{$quiz->id}}').submit();
                                                              }">
                                                        Deactivate
                                                    </a>
                                                    <form id="activate-form-{{$quiz->id}}" action="{{ route('instructor.quiz.status', [$course->id, $quiz->id]) }}" method="post">
                                                      @csrf {{method_field('PUT')}}
                                                      <input type="hidden" name="status" value="1">
                                                    </form>
                                                @endif --}}
                                                test
                                            </td>
                                            <td>
                                                <a href="{{route('instructor.quiz.edit', [$course->id, $quiz->id])}}" class="blue-text">Update</a> |
                                                <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this quiz?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$quiz->id}}').submit();
                                                          }">
                                                    Delete
                                                </a>
                                                <form id="delete-instructor-form-{{$quiz->id}}" action="{{ route('instructor.quiz.destroy', [$course->id, $quiz->id]) }}" method="post">
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
