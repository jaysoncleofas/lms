@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-md-9">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Add Instructor</h3>
                <a href="{{route('admin.instructor.index')}}" class="btn btn-danger">Back</a>
            </div>
            <form action="{{route('admin.instructor.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col-sm-12 col-lg-4">
                        <div class="md-form">
                            <input type="text" name="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}"
                                value="{{old('firstName')}}">
                            <label>First name</label>
                            @if ($errors->has('firstName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('firstName') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="md-form">
                            <input type="text" name="middleName" class="form-control" value="{{old('middleName')}}">
                            <label>Middle name</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="md-form">
                            <input type="text" name="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}"
                                value="{{old('lastName')}}">
                            <label>Last name</label>
                            @if ($errors->has('lastName'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lastName') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="md-form">
                    <input placeholder="Select date" type="text" name="birthDate" class="form-control datepicker {{$errors->has('birthDate') ? 'is-invalid' : ''}}"
                        value="{{old('birthDate')}}">
                    <label>Date of Birth</label>
                    @if ($errors->has('birthDate'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('birthDate') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"
                        value="{{old('email')}}">
                    <label>Email Address</label>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>


                <div class="md-form">
                    <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                        value="{{old('username')}}">
                    <label>Username</label>
                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="md-form">
                    <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                    <label>Password</label>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Save</button>
            </form>
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
