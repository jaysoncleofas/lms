@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">Course{{count($courses) > 1 ? 's' : ''}}</h3>
        <a href="{{route('admin.course.create')}}" class="btn btn-primary">Add course</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">

            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">Course</th>
                        <th class="th-sm">Instructors</th>
                        <th class="th-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td>{{$course->name}}</td>
                        <td>
                            @foreach ($course->users as $instructor)
                            {{$instructor->firstName.' '.$instructor->lastName}},
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('admin.course.edit', $course->id)}}" class="blue-text">Update</a> |
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to delete this course?')) {
                                                            event.preventDefault();
                                                            $('#delete-course-form-{{$course->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-course-form-{{$course->id}}" action="{{ route('admin.course.destroy', $course->id) }}"
                                method="post">
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
@endsection

@section('script')
<script src="{{ asset('js/addons/datatables.min.js') }}"></script>
@include('partials.notification')
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            }
        });
    });

</script>
@endsection
