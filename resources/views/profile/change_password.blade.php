@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-oswald">Change Password</h3>
            </div>
        </div>
        <div class="row mt-lg-3">
            <div class="col-lg-8">
                <div class="form-row">
                    <div class="col-lg-12">
                        <div class="md-form">
                            <input type="text" name="current_password" class="form-control {{$errors->has('current_password') ? 'is-invalid' : ''}}" value="{{$user->current_password}}">
                            <label>Current Password</label>
                            @if ($errors->has('current_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <div class="md-form">
                            <input type="text" name="new_password" class="form-control {{$errors->has('new_password') ? 'is-invalid' : ''}}" value="{{$user->new_password}}">
                            <label>New Password</label>
                            @if ($errors->has('new_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <div class="md-form">
                            <input type="text" name="new_password" class="form-control {{$errors->has('new_password') ? 'is-invalid' : ''}}" value="{{$user->new_password}}">
                            <label>Confirm Password</label>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Update</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
