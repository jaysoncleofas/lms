@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h3 class="text-oswald">Change Password</h3>

                <form class="" action="{{route('change.password.update')}}" method="post">
                    @csrf {{method_field('PUT')}}
                    <div class="form-row">
                        <div class="col-lg-12">
                            <div class="md-form">
                                <input type="password" name="oldpassword" class="form-control {{$errors->has('oldpassword') ? 'is-invalid' : ''}}">
                                <label>Current Password</label>
                                @if ($errors->has('oldpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="md-form">
                                <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                                <label>New Password</label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="md-form">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
