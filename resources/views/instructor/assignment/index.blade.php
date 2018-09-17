@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
        <a href="{{route('instructor.assignment.create', $course->id)}}" class="btn btn-primary">Add Assignment</a>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($assignments)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Assignments</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sections</th>
                        <th>Questions</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignments as $assignment)
                    <tr>
                        <td><a href="{{ route('instructor.assignment.show', [$course->id, $assignment->id]) }}" class="blue-text">{{$assignment->title}}</a></td>
                        <td>
                            @foreach ($assignment->sections as $section2)
                            {{$section2->name}},
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('instructor.question.assignmentCreate', [$course->id, $assignment->id])}}"
                                class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Add question">{{count($assignment->questions)}}
                            </a>
                        </td>
                        <td>
                            {{$assignment->expireDate ? date('F j, Y',strtotime($assignment->expireDate)) : ''}}
                        </td>
                        <td>
                            @if ($assignment->isActive == true)
                            <a href="#" class="btn btn-success btn-sm" onclick="if(confirm('Are you sure you want to deactivate this assignment?')) {
                                                                                event.preventDefault();
                                                                                $('#deactivate-form-{{$assignment->id}}').submit();
                                                                              }">
                                Active
                            </a>
                            <form id="deactivate-form-{{$assignment->id}}" action="{{ route('instructor.assignment.status', [$course->id, $assignment->id]) }}"
                                method="post">
                                @csrf {{method_field('PUT')}}
                                <input type="hidden" name="status" value="0">
                            </form>
                            @else
                            <a href="#" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to activate this assignment?')) {
                                                                                event.preventDefault();
                                                                                $('#activate-form-{{$assignment->id}}').submit();
                                                                              }">
                                Deactivate
                            </a>
                            <form id="activate-form-{{$assignment->id}}" action="{{ route('instructor.assignment.status', [$course->id, $assignment->id]) }}"
                                method="post">
                                @csrf {{method_field('PUT')}}
                                <input type="hidden" name="status" value="1">
                            </form>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('instructor.assignment.edit', [$course->id, $assignment->id])}}" class="blue-text">Update</a>
                            |
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to delete this assignment?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$assignment->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-instructor-form-{{$assignment->id}}" action="{{ route('instructor.assignment.destroy', [$course->id, $assignment->id]) }}"
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
