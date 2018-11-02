@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold"><strong>Courses</strong></h3>
        <a href="{{route('admin.course.create')}}" class="btn btn-primary mr-0"><i class="fa fa-plus"></i> Add course</a>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-list fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($courses) )}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Course{{ count($courses) > 1 ? 's' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
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
                                <td style="white-space: normal;">
                                    @foreach ($course->users as $instructor)
                                        <a class="btn-link" href="{{route('admin.instructor.show', $instructor->id)}}">{{$instructor->firstName.' '.$instructor->lastName}}</a>,
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('admin.course.edit', $course->id)}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil-alt"></i></a> 
                                    <a href="javascript:void(0);" data-href="{{ route('admin.course.destroy', $course->id) }}" class="perma_delete text-danger" data-placement="right" data-method="delete" data-from="course" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> 
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
@include('partials.notification')
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order: []
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });

</script>
@endsection
