@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-save fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($quiz->takeQuizzes)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Submitted{{count($quiz->takeQuizzes) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-2">
    <div class="row mt-0">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $quiz->isCode ? "Code " : '' }}Quiz: {{$quiz->title}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-3">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Section</th>
                                <th>Student</th>
                                <th>Date</th>
                                <th>Result</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quiz->takeQuizzes as $key => $take)
                            <tr>
                                <td>{{ $key+1 }}.</td>
                                <td>{{ $take->section->name }}</td>
                                <td>{{ $take->user->name() }}</td>
                                <td>{{ $take->created_at->toDayDateTimeString() }}</td>
                                <td>{{ $take->result }}</td>
                                <td>
                                    <a href="{{ route('instructor.quiz.takeShow', [$course->id, $quiz->id, $take->id]) }}" class="blue-text mr-3" data-toggle="tooltip" title="View" data-placement="left"><i class="fa fa-eye"></i></a> 
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
@endsection

@section('script')
<script src="{{ asset('js/addons/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order:[]
        });
    });

</script>
@endsection
