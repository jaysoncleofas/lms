@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('check_token') }}">
                        @csrf
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="text" name="token" class="form-control {{$errors->has('token') ? 'is-invalid' : ''}}" value="{{old('token')}}">
                                <label>Token</label>
                                @if ($errors->has('token'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
