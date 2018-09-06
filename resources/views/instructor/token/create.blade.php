@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <a class="breadcrumb-item" href="{{route('instructor.token.index', $course->id)}}">Token</a>
                    {{-- <span class="breadcrumb-item active">Add</span> --}}
                </nav>
            </div>
        </div>

        <div class="row justify-content-center mt-lg-3">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Generate Token for a certain section</a>
                        <div>
                            <a href="{{route('instructor.token.index', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Back to Token list"><i class="fa fa-chevron-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="" action="{{route('instructor.token.store', $course->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <select class="mdb-select" name="section">
                                            <option selected disabled>Select</option>
                                            @foreach ($sections as $section)
                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                        <label>Section in this course</label>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" name="button" class="btn btn-primary btn-sm pull-right">Generate</button>
                        </form>
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
            $('.mdb-select').material_select();
            $('#example').DataTable();
        });
    </script>
@endsection
