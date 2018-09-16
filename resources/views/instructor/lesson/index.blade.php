@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
        <a href="{{route('instructor.lesson.create', $course->id)}}" class="btn btn-primary">Add Lesson</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($lessons)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Lessons</h2>
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
                        <th>File</th>
                        <th>Status</th>
                        <th>Action</th>
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
                        <td><a href="{{route('instructor.lesson.download', [$course->id, $lesson->id])}}" class="blue-text">{{substr($lesson->upload_file,
                                20)}}</a></td>
                        <td>
                            @if ($lesson->status == 1)
                            <a href="#" class="btn btn-sm btn-success" onclick="if(confirm('Are you sure you want to deactivate this lesson?')) {
                                                                event.preventDefault();
                                                                $('#deactivate-form-{{$lesson->id}}').submit();
                                                              }">
                                Active
                            </a>
                            <form id="deactivate-form-{{$lesson->id}}" action="{{ route('instructor.lesson.status', [$course->id, $lesson->id]) }}"
                                method="post">
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
                            <form id="activate-form-{{$lesson->id}}" action="{{ route('instructor.lesson.status', [$course->id, $lesson->id]) }}"
                                method="post">
                                @csrf {{method_field('PUT')}}
                                <input type="hidden" name="status" value="1">
                            </form>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('instructor.lesson.edit', [$course->id, $lesson->id])}}" class="blue-text">Update</a>
                            |
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to delete this lesson?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$lesson->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-instructor-form-{{$lesson->id}}" action="{{ route('instructor.lesson.destroy', [$course->id, $lesson->id]) }}"
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
