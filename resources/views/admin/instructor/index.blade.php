@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Instructors</h3>
        <a href="{{route('admin.instructor.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add instructor</a>
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

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <a href="{{route('admin.instructor.trash')}}" class="btn btn-link"><i class="fa fa-trash red-text"></i> Trash</a>
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
                                <td><a class="btn-link" href="{{route('admin.instructor.show', $instructor->id)}}">{{$instructor->firstName.' '.$instructor->lastName}}</a></td>
                                <td>{{$instructor->email}}</td>
                                <td>{{$instructor->username}}</td>
                                <td>{{$instructor->mobileNumber}}</td>
                                <td>
                                    <a href="{{route('admin.instructor.edit', $instructor->id)}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="javascript:void(0);" data-href="{{ route('admin.instructor.destroy', $instructor->id) }}" class="anchor_delete text-danger" data-method="delete" data-from="instructor" data-toggle="tooltip" title="Delete" data-placement="right"><i class="fa fa-trash"></i></a> 
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
