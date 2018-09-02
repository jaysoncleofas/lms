@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mt-lg-5">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Courses table</a>
                        <div>
                            <a href="{{route('admin.course.create')}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Code</td>
                                        <td>Description</td>
                                        <td>Date Created</td>
                                        <td>Instructors</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{$course->name}}</td>
                                            <td>{{$course->code}}</td>
                                            <td>{{$course->description}}</td>
                                            <td>{{date('F j, Y',strtotime($course->created_at))}}</td>
                                            <td>
                                                @foreach ($course->users as $instructor)
                                                    {{$instructor->firstName.' '.$instructor->lastName}}, 
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{route('admin.course.edit', $course->id)}}" class="blue-text">Update</a> |
                                                <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this course?')) {
                                                            event.preventDefault();
                                                            $('#delete-course-form-{{$course->id}}').submit();
                                                          }">
                                                    Delete
                                                </a>
                                                <form id="delete-course-form-{{$course->id}}" action="{{ route('admin.course.destroy', $course->id) }}" method="post">
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
