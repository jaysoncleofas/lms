@extends('layouts.app')

@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <nav class="breadcrumb">
                  <a class="breadcrumb-item" href="{{route('admin.instructor.create')}}">Instructor</a>
                  <span class="breadcrumb-item active">Update</span>
              </nav>
          </div>
      </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Update Instructor</a>
                        <div>
                            <a href="{{route('admin.instructor.index')}}" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-chevron-circle-left mt-0"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.instructor.update', $instructor->id)}}" method="post">
                            {{ csrf_field() }} {{method_field('PUT')}}
                            <div class="form-row">
                                <div class="col">
                                    <div class="md-form">
                                        <input type="text" name="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{$instructor->firstName}}">
                                        <label>First name</label>
                                        @if ($errors->has('firstName'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('firstName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="md-form">
                                        <input type="text" name="middleName" class="form-control" value="{{$instructor->middleName}}">
                                        <label>Middle name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="md-form">
                                        <input type="text" name="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{$instructor->lastName}}">
                                        <label>Last name</label>
                                        @if ($errors->has('lastName'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lastName') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="md-form">
                                        <input placeholder="Select date" type="text" name="birthDate" class="form-control datepicker {{$errors->has('birthDate') ? 'is-invalid' : ''}}" value="{{date('j F, Y',strtotime($instructor->birthDate))}}">
                                        <label>Date of Birth</label>
                                        @if ($errors->has('birthDate'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birthDate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="md-form">
                                        <input type="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{$instructor->email}}">
                                        <label>Email Address</label>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="md-form">
                                        <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{$instructor->username}}">
                                        <label>Username</label>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                                        <label>Password</label>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
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
    <script>
    $('.datepicker').pickadate({
        max: new Date(),
        formatSubmit: 'yyyy-mm-dd',
        hiddenPrefix: 'formatted_',
        selectYears: 50
    });
    </script>
@endsection
