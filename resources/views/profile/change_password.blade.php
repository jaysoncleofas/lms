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
                                <input type="password" name="currentPassword" id="currentPassword" value="{{old('currentPassword')}}" class="form-control {{$errors->has('currentPassword') ? 'is-invalid' : ''}}">
                                <label for="currentPassword">Current Password <span class="red-asterisk">*</span></label>
                                @if ($errors->has('currentPassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('currentPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="md-form">
                                <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
                                <label for="password">New Password <span class="red-asterisk">*</span></label>
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
                                <input id="password-confirm" type="password" class="form-control {{$errors->has('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation">
                                <label for="password-confirm" class="form-label">Confirm Password <span class="red-asterisk">*</span></label>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
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
