@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">Deleted Instructor{{count($instructors) > 1 ? 's' : ''}}</h3>
        <a href="{{route('admin.instructor.index')}}" class="btn btn-danger">Back</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">
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
                            <a href="javascript:void(0);" data-href="{{ route('admin.instructor.restore', $instructor->id) }}" class="restore text-success" data-method="put" data-from="instructor">Restore</a>
                            |
                            <a href="javascript:void(0);" data-href="{{ route('admin.instructor.forceDestroy', $instructor->id) }}" class="perma_delete text-danger" data-method="delete" data-from="instructor">Delete</a>                              
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
