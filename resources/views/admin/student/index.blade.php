@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Students</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-2 justify-content-between">
        <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-graduation-cap fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ number_format(count($students) )}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Student{{ count($students) > 1 ? 's' : '' }}</h2>
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
                                <th>Registered Since</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->name()}}</td>
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
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/addons/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order:[]
        });
    });

</script>
@endsection
