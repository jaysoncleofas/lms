@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-oswald">Profile</h3>
            </div>
        </div>
        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }} {{method_field('PUT')}}
            <div class="row mt-lg-3">
                <div class="col-lg-4 mb-5">
                    <div class="col-md-12">
                        <div class="md-form">
                            <img class="img-fluid img-preview z-depth-1">
                            <div class="file-field">
                                <div class="btn btn-primary btn-sm float-left">
                                    <span>Choose file</span>
                                    <input type="file" name="avatar" onchange="previewFile()">
                                </div>
                                <a class="btn btn-danger btn-sm float-left" onclick="
                                            event.preventDefault();
                                            $('#remove-profile-pic-{{$user->id}}').submit();
                                          ">
                                    <span>Remove</span>
                                </a>
                            </div>

                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form">
                                <input type="text" name="firstName" id="firstName" class="form-control {{$errors->has('firstName') ? 'is-invalid' : ''}}" value="{{$user->firstName}}">
                                <label for="firstName">First name</label>
                                @if ($errors->has('firstName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input type="text" name="middleName" id="middleName" class="form-control {{$errors->has('middleName') ? 'is-invalid' : ''}}" value="{{$user->middleName ? $user->middleName : old('middleName')}}">
                                <label for="middleName">Middle name</label>
                                @if ($errors->has('middleName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middleName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input type="text" name="lastName" id="lastName" class="form-control {{$errors->has('lastName') ? 'is-invalid' : ''}}" value="{{$user->lastName}}">
                                <label for="lastName">Last name</label>
                                @if ($errors->has('lastName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-12">
                            <div class="md-form">
                                <input placeholder="Select date" type="text" name="birthDate" id="birthDate" class="form-control datepicker {{$errors->has('birthDate') ? 'is-invalid' : ''}}" value="{{date('j F, Y',strtotime($user->birthDate))}}">
                                <label for="birthDate">Date of Birth</label>
                                @if ($errors->has('birthDate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="md-form">
                                <input type="email" name="email" id="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" value="{{$user->email}}">
                                <label for="email">Email Address</label>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="md-form">
                        <input type="text" name="mobileNumber" id="mobileNumber" class="form-control {{$errors->has('mobileNumber') ? 'is-invalid' : ''}}"
                            value="{{$user->mobileNumber ? $user->mobileNumber : old('mobileNumber')}}">
                        <label for="mobileNumber">Mobile Number</label>
                        @if ($errors->has('mobileNumber'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mobileNumber') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="col-12">
                            <div class="md-form">
                                <input type="text" name="username" id="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" value="{{$user->username}}">
                                <label for="username">Username</label>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Update</button>
                </div>
            </div>
        </form>
        <form id="remove-profile-pic-{{$user->id}}" action="{{ route('profile.picture.remove') }}" method="post">
          @csrf {{method_field('PUT')}}

        </form>
    </div>
@endsection

@section('script')
    @include('partials.notification')
    <script>
        $('.datepicker').pickadate({
            max: new Date(2003,11,31),
            formatSubmit: 'yyyy-mm-dd',
            hiddenPrefix: 'formatted_',
            selectYears: 50
        });

        function previewFile(){
            var preview = document.querySelector('.img-preview'); //selects the query named img
            var file    = document.querySelector('input[type=file]').files[0]; //sames as here
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file); //reads the data as a URL
            } else {
                preview.src = "{{$user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('images/profile_pic.png')}}";
            }

        }

    previewFile();  //calls the function named previewFile()


    </script>
@endsection
