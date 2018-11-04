@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span> </h3>
            <h4 class="text-oswald font-weight-bold">Section: <span class="font-weight-normal">{{ $section->name }}</span></h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-users fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($section->users)) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Student{{ count($section->users) > 1 ? 's' : '' }}</h2>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($section->users as $user)
                            <tr>
                                <td>{{ $user->name() }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobileNumber }}</td>
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
