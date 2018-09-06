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
                  <span class="breadcrumb-item active">Lesson</span>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Lesson list</a>
                        <div>
                            <a href="{{route('instructor.lesson.create', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <td>Title</td>
                                        <td>Sections</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lessons as $lesson)
                                        <tr>
                                            <td><a href="{{ route('instructor.lesson.show', [$course->id, $lesson->id]) }}" class="blue-text">{{$lesson->title}}</a></td>
                                            <td>
                                                @foreach ($lesson->sections as $section2)
                                                    {{$section2->name}},
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($lesson->status == 1)
                                                    <a href="#" class="btn btn-sm btn-success" onclick="if(confirm('Are you sure you want to deactivate this lesson?')) {
                                                                event.preventDefault();
                                                                $('#deactivate-form-{{$lesson->id}}').submit();
                                                              }">
                                                              Active
                                                    </a>
                                                    <form id="deactivate-form-{{$lesson->id}}" action="{{ route('instructor.lesson.status', [$course->id, $lesson->id]) }}" method="post">
                                                      @csrf {{method_field('PUT')}}
                                                      <input type="hidden" name="status" value="0">
                                                    </form>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to activate this lesson?')) {
                                                                event.preventDefault();
                                                                $('#activate-form-{{$lesson->id}}').submit();
                                                              }">
                                                        Deactivate
                                                    </a>
                                                    <form id="activate-form-{{$lesson->id}}" action="{{ route('instructor.lesson.status', [$course->id, $lesson->id]) }}" method="post">
                                                      @csrf {{method_field('PUT')}}
                                                      <input type="hidden" name="status" value="1">
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('instructor.lesson.edit', [$course->id, $lesson->id])}}" class="blue-text">Update</a> |
                                                <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this lesson?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$lesson->id}}').submit();
                                                          }">
                                                    Delete
                                                </a>
                                                <form id="delete-instructor-form-{{$lesson->id}}" action="{{ route('instructor.lesson.destroy', [$course->id, $lesson->id]) }}" method="post">
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
