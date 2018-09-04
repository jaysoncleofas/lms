@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <nav class="breadcrumb">
                  <span class="breadcrumb-item active">Instructors</span>
                  <span class="breadcrumb-item active">List</span>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Instructors table</a>
                        <div>
                            <a href="{{route('admin.instructor.create')}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Username</td>
                                        <td>Birth Date</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $instructor)
                                        <tr>
                                            <td>{{$instructor->firstName.' '.$instructor->lastName}}</td>
                                            <td>{{$instructor->email}}</td>
                                            <td>{{$instructor->username}}</td>
                                            <td>{{date('F j, Y',strtotime($instructor->birthDate))}}</td>
                                            <td>
                                                <a href="{{route('admin.instructor.edit', $instructor->id)}}" class="blue-text">Update</a> |
                                                <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this instructor?')) {
                                                            event.preventDefault();
                                                            $('#delete-instructor-form-{{$instructor->id}}').submit();
                                                          }">
                                                    Delete
                                                </a>
                                                <form id="delete-instructor-form-{{$instructor->id}}" action="{{ route('admin.instructor.destroy', $instructor->id) }}" method="post">
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('Datatables/datatables.min.js') }}"></script>
    @include('partials.notification')
    <script>
    $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
