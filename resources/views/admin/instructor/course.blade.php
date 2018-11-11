@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Instructor Profile</h3> 
        <a href="{{route('admin.instructor.show', $instructor->id)}}" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>

    <div class="row mt-3">
        <div class="col-md-2 col-sm-4 text-center">
            <img src="{{ $instructor->avatar ? asset('storage/avatars/'.$instructor->avatar) : asset('images/profile_pic.png')}}" class="img-fluid rounded-circle z-depth-1" style="height:100px;width:100px;object-fit:cover;" alt="">
        </div>
        <div class="col-md-5 col-sm-8 mt-3 instructor-des">
            <p><b>Name:</b> {{ $instructor->name() }}</p> 
            <p><b>Email-Address:</b> {{ $instructor->email }}</p>   
            <p><b>Username:</b> {{ $instructor->username }}</p>   
            @if ($instructor->mobileNumber)
                <p><b>Mobile Number:</b> {{ $instructor->mobileNumber }}</p>   
            @endif
        </div>    
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <hr>
            <h4 class="text-oswald"><strong>Course:</strong> {{$course->name}} 
                {{-- / Section{{count($sections) > 1 ? 's' : ''}} --}}
            </h4>
        </div>
        @if ( count($sections) == 0 )
        <div class="col-xl-12 col-md-12 mb-3">
            <div class="card py-5">
                <div class="card-body text-center">
                    <h4 class="text-osald">No section available</h4>
                </div>
            </div>
        </div>
        @else    
            @foreach ($sections as $section)
                @if ($section->isActive == 1)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card">
                            <div class="justify-content-between d-flex">
                                <p class="my-1 mx-1 green-text">Active</p>
                            </div>
                            <div class="view overlay text-white text-center pb-4">
                                    <h2 class="text-uppercase card-title text-oswald">{{$section->name}}</h2>
                                    <h2 class="text-uppercase text-oswald">{{count($section->users)}} student{{count($section->users) > 1 ? 's' : ''}}</h2>
                                <a href="{{route('admin.instructor.section', [$instructor->id, $course->id, $section->id])}}" class="px-4">
                                    <div class="mask rgba-white-slight">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>   
                @endif
            @endforeach
        @endif
        <div class="col-xl-12 col-md-12 mb-3">
            <hr>
            <div class="row">
                @foreach ($sections as $section)
                    @if ($section->isActive == 0)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card">
                                <div class="justify-content-between d-flex">
                                    <p class="my-1 mx-1 red-text">Deactivated</p>
                                </div>
                                <div class="view overlay text-white text-center pb-4">
                                        <h2 class="text-uppercase card-title text-oswald">{{$section->name}}</h2>
                                        <h2 class="text-uppercase text-oswald">{{count($section->users)}} student{{count($section->users) > 1 ? 's' : ''}}</h2>
                                    <a href="{{route('admin.instructor.section', [$instructor->id, $course->id, $section->id])}}" class="px-4">
                                        <div class="mask rgba-white-slight">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>    
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
