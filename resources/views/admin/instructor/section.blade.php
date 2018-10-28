@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald text-capitalize">{{$instructor->firstName .' '.$instructor->lastName}}</h3>
        <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h4 class="text-oswald mb-3">{{$course->name}} / {{$section->name}}</h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->lessons)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Lesson{{count($section->lessons) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->quizzes)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Quiz{{count($section->quizzes) > 1 ? 'zes' : ''}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->assignments)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Assignment{{count($section->assignments) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">
        <h4>{{count($section->users)}} Student{{count($section->users) > 1 ? 's' : ''}}</h4>
            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Registered Since</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->users as $student)
                    <tr>
                        <td>{{$student->firstName.' '.$student->lastName}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->mobileNumber}}</td>
                        <td>{{date('F j, Y',strtotime($student->created_at))}}</td>
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
