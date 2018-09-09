@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('check_token') }}">
                        @csrf
                        <p class="h4 mb-4">Register</p>
                        {{-- <div class="col-md-12"> --}}
                            <div class="md-form">
                                <input type="text" name="classToken" class="form-control {{$errors->has('classToken') ? 'is-invalid' : ''}}" value="{{old('classToken')}}">
                                <label>Token</label>
                                @if ($errors->has('classToken'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('classToken') }}</strong>
                                    </span>
                                @endif
                            </div>
                        {{-- </div> --}}
                        <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
