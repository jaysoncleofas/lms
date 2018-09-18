@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-5">

                    <h3 class="text-center text-oswald mb-5">{{$section->course->name}} / {{$section->section->name}}</h3>
                {{-- <p>{{$section->course->name}}</p> --}}
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="sections" value="{{$section->section->id}}">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="text" name="firstName" id="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{old('firstName')}}">
                                    <label for="firstName">First name</label>
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
                                    <label for="middleName">Middle name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="md-form">
                                    <input type="text" name="lastName" id="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{old('lastName')}}">
                                    <label for="lastName">Last name</label>
                                    @if ($errors->has('lastName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                                <div class="md-form">
                                    <input placeholder="Select date" type="text" name="birthDate" id="birthDate" class="form-control datepicker {{$errors->has('birthDate') ? 'is-invalid' : ''}}" value="{{old('birthDate')}}">
                                    <label for="birthDate">Date of Birth</label>
                                    @if ($errors->has('birthDate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birthDate') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form">
                                    <input type="email" id="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{old('email')}}">
                                    <label for="email">Email Address</label>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="md-form">
                                    <input type="text" id="username" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{old('username')}}">
                                    <label for="username">Username</label>
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form">
                                    <input type="password" id="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                                    <label for="password">Password</label>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="md-form">
                                    <input type="password" id="password-confirm" name="password_confirmation" class="form-control">
                                    <label for="password-confirm">Confirm Password</label>
                                </div>


                        <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Register</button>
                    </form>


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
