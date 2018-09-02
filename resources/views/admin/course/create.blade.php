@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mt-lg-5 justify-content-center">
            <div class="col-xl-6 col-md-6 mb-5 pb-5">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Add Course</a>
                        <div>
                            <a href="{{route('admin.course.index')}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-chevron-circle-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.course.store')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="md-form">
                                        <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{old('name')}}">
                                        <label>Course Name</label>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input type="text" name="code" class="form-control {{$errors->has('code') ? 'is-invalid' : ''}}" value="{{old('code')}}">
                                        <label>Course code</label>
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <textarea type="text" name="description" class="md-textarea form-control {{$errors->has('description') ? 'is-invalid' : ''}}" rows="3">{{old('description')}}</textarea>
                                        <label>Description</label>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <p>Assign Instructors</p>
                                    <div class="md-form">
                                         <select class="multiple-select form-control" multiple="multiple" name="instructors[]" required style="width:100% !important;">
                                            @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}">{{ $instructor->firstName.' '.$instructor->lastName }}</option>
                                            @endforeach
                                         </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
    $('.multiple-select').select2();
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });
    </script>
@endsection
