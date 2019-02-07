@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10 mt-5">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">{{$section->course->name}} / {{$section->section->name}}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="sections" value="{{$section->section->id}}">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="text" name="firstName" id="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{old('firstName')}}">
                                    <label for="firstName">First Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('firstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="text" name="middleName" id="middleName" class="form-control" value="{{old('middleName')}}">
                                    <label for="middleName">Middle Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="text" name="lastName" id="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{old('lastName')}}">
                                    <label for="lastName">Last Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form">
                                    <input type="text" name="studentNumber" id="studentNumber" class="form-control {{$errors->has('studentNumber') ? 'is-invalid' : ''}}" value="{{old('studentNumber')}}">
                                    <label for="studentNumber">Student Number <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('studentNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('studentNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                    <input type="text" name="birthDate" id="birthDate" class="form-control datepicker {{$errors->has('birthDate') ? 'is-invalid' : ''}}" value="{{old('birthDate')}}">
                                    <label for="birthDate">Date of Birth <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('birthDate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form">
                                    <input type="email" id="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}">
                                    <label for="email">Email Address <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form">
                                    <input type="text" name="mobileNumber" id="mobileNumber" class="form-control {{$errors->has('mobileNumber') ? 'is-invalid' : ''}}" value="{{old('mobileNumber')}}">
                                    <label for="mobileNumber">Mobile Number</label>
                                    @if ($errors->has('mobileNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobileNumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div> 

                        <div class="md-form">
                            <input type="text" id="username" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{old('username')}}">
                            <label for="username">Username <span class="red-asterisk">*</span></label>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                            <label for="password">Password <span class="red-asterisk">*</span></label>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
        
                        <div class="md-form">
                            <input type="password" id="password-confirm" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}">
                            <label for="password-confirm">Confirm Password <span class="red-asterisk">*</span></label>
                            @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
        
        
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-check"></i> Register</button>
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
        selectYears: 10,
        max: new Date(2003,11,31)
    });
</script>
@endsection
