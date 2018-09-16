@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald">{{$course->name}}</h3>
            <h4 class="text-oswald">Assignment / {{$assignment->title}}</h4>
        </div>

        <div>
            <a href="{{route('instructor.assignment.index', $course->id)}}" class="btn btn-primary">Assignments</a>
            <a href="{{route('instructor.question.assignmentCreate', [$course->id, $assignment->id])}}" class="btn btn-primary">Add Question</a>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($questions)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Questions</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
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
                        <td> <img src="{{asset('storage/images/'.$question->question_image)}}" class="img-fluid" style="height:50px;"
                                alt=""> </td>
                        <td>
                            <a href="{{route('instructor.question.assignmentEdit', [$course->id, $assignment->id, $question->id])}}"
                                class="blue-text">Update</a> |
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to delete this question?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$question->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-instructor-form-{{$question->id}}" action="{{ route('instructor.question.assignmentDestroy', [$course->id, $assignment->id, $question->id]) }}"
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
