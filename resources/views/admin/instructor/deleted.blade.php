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
                            <a class="text-success" onclick="if(confirm('Are you sure you want to restore this instructor?')) {
                                                            event.preventDefault();
                                                            $('#restore-instructor-form-{{$instructor->id}}').submit();
                                                          }"> Restore </a>
                                                          |
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to permamently delete this instructor?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$instructor->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-instructor-form-{{$instructor->id}}" action="{{ route('admin.instructor.forceDestroy', $instructor->id) }}" method="post">
                                @csrf {{method_field('DELETE')}}
                            </form>
                            <form id="restore-instructor-form-{{$instructor->id}}" action="{{ route('admin.instructor.restore', $instructor->id) }}" method="post">
                                @csrf {{method_field('PUT')}}
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
