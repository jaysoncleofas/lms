@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald">{{$course->name}}</h3>
            <h4 class="text-oswald">Section / {{$section->name}}</h4>
        </div>
        <div>
            <a href="{{route('instructor.section.index', $course->id)}}" class="btn btn-primary">Sections</a>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($section->users)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Students</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">

            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($section->users as $user)
                    <tr>
                        <td>{{$user->firstName.' '.$user->lastName}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{route('instructor.student.show', [$course->id, $section->id, $user->id])}}" class="blue-text">View</a>
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
