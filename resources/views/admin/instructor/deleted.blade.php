@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Deleted Instructor{{count($instructors) > 1 ? 's' : ''}}</h3>
        {{-- <a href="{{route('admin.instructor.index')}}" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a> --}}
    </div>

    <div class="row mt-3">
        <div class="col-lg-5 col-md-5 col-sm-6 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-chalkboard-teacher fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($instructors)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Instructor{{ count($instructors) > 1 ? 's' : '' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Username</td>
                                <td>Mobile Number</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructors as $instructor)
                            <tr>
                                <td>{{$instructor->firstName.' '.$instructor->lastName}}</td>
                                <td>{{$instructor->email}}</td>
                                <td>{{$instructor->username}}</td>
                                <td>{{$instructor->mobileNumber}}</td>
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ route('admin.instructor.restore', $instructor->id) }}" class="restore text-success mr-3" data-method="put" data-from="instructor" data-toggle="tooltip" title="Restore" data-placement="left"><i class="fa fa-undo"></i></a>
                                    <a href="javascript:void(0);" data-href="{{ route('admin.instructor.forceDestroy', $instructor->id) }}" class="perma_delete text-danger" data-method="delete" data-from="instructor" data-toggle="tooltip" title="Delete" data-placement="right"><i class="fa fa-trash"></i></a>                              
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
    });

</script>
@endsection
