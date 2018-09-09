@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <a class="breadcrumb-item" href="{{route('instructor.section.index', $course->id)}}">Sections</a>
                    {{-- <span class="breadcrumb-item active"></span> --}}
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-6 col-md-6 mb-5 pb-5">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Add Section</a>
                        <div>
                            <a href="{{route('instructor.section.index', $course->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Back to Sections"><i class="fa fa-chevron-circle-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('instructor.section.store', $course->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="md-form">
                                        <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{old('name')}}">
                                        <label>Section Name</label>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="button" class="btn btn-primary pull-right btn-sm mt-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
