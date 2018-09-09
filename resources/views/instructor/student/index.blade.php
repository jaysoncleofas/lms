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
                  <a class="breadcrumb-item" href="{{route('instructor.section.index', $course->id)}}">Section</a>
                  <span class="breadcrumb-item active">{{$section->name}}</span>
                </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Student list</a>
                        <div>
                            <a href="{{route('instructor.quiz.create', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        {{-- <td></td> --}}
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($section->users as $user)
                                    <tr>
                                        <td>{{$user->firstName.' '.$user->lastName}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="" class="blue-text">View</a>
                                        </td>
                                    </tr>
                                        {{-- <tr>

                                            <td><a href="{{ route('instructor.quiz.show', [$course->id, $quiz->id]) }}" class="blue-text">{{$quiz->title}}</a></td>
                                            <td>
                                                @foreach ($quiz->sections as $section2)
                                                    {{$section2->name}},
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{route('instructor.question.create', [$course->id, $quiz->id])}}" class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Add question">{{count($quiz->questions)}} </a>
                                            </td>
                                            <td>
                                                @if ($quiz->isActive == true)
                                                    <a href="#" class="btn btn-success btn-sm">Active</a>
                                                @else
                                                    <a href="#" class="btn btn-danger btn-sm">Deactivate</a>
                                                @endif
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
                                        </tr> --}}
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
