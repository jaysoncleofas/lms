@extends('layouts.guest_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 mt-5">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Register</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('check_token') }}">
                        @csrf
                        {{-- <div class="col-md-12"> --}}
                            <div class="md-form">
                                <input type="text" name="classToken" id="classToken" class="form-control {{$errors->has('classToken') ? 'is-invalid' : ''}}" value="{{old('classToken')}}">
                                <label for="classToken">Token</label>
                                @if ($errors->has('classToken'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('classToken') }}</strong>
                                    </span>
                                @endif
                            </div>
                        {{-- </div> --}}
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-check"></i> Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
