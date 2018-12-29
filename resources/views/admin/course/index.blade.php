@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>Courses</h3>
            </div>
            <a href="{{route('admin.course.create')}}" class="btn btn-primary mr-0 my-0"><i class="fa fa-plus"></i> Add course</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
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
                    <table id="table" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Course</th>
                                <th class="th-sm">Instructors</th>
                                <th class="th-sm">Action</th>
                            </tr>
                        </thead>
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
        $('#table').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: "{!! route('admin.courseList') !!}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'instructors', name: 'instructors'},
                {data: 'action', name: 'action'},
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order: [],
        });
        // tooltip for datatables
        $('table').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        })
    });
</script>
@endsection
