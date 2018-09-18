@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">Student{{count($students) > 1 ? 's' : ''}}</h3>
        {{-- <a href="{{route('admin.instructor.create')}}" class="btn btn-primary">Add instructor</a> --}}
    </div>
    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Registered Since</th>
                        {{-- <td>Birth Date</td> --}}
                        {{-- <td>Action</td> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{$student->firstName.' '.$student->lastName}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->mobileNumber}}</td>
                        <td>{{date('F j, Y',strtotime($student->created_at))}}</td>
                        {{-- <td>{{date('F j, Y',strtotime($instructor->birthDate))}}</td> --}}
                        {{-- <td>
                            <a href="{{route('admin.instructor.edit', $instructor->id)}}" class="blue-text">Update</a>
                            |
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to delete this instructor?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$instructor->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-instructor-form-{{$instructor->id}}" action="{{ route('admin.instructor.destroy', $instructor->id) }}"
                                method="post">
                                @csrf {{method_field('DELETE')}}

                            </form>
                        </td> --}}
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
