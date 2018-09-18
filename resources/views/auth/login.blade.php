@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 my-5">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <img src="{{asset('images/ccs.png')}}" class="img-fluid" alt="">
                    </div>
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="md-form">
                            <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            <label for="email">Email Address</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="md-form">
                            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                            <label for="password">Password</label>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row justify-content-between d-flex">
                            <div class="md-form mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary btn-block mt-4">Login</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
