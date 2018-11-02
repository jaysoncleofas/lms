@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Instructor Profile</h3> 
        {{-- <a href="{{ route('admin.instructor.index') }}" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back to list</a> --}}
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
            <h4 class="text-oswald">Course{{count($instructor->courses) > 1 ? 's' : ''}}</h4>
        </div>
        @if ( count($instructor->courses) == 0 )
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card py-5">
                <div class="card-body text-center">
                    <h4 class="text-osald">No course available</h4>
                </div>
            </div>
        </div>
        @else    
            @foreach ($instructor->courses as $course)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body justify-content-between d-flex">
                        <a href="{{route('admin.course.edit', $course->id)}}" class="px-2 pull-left blue-text waves-effect" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-alt pr-1"></i></a>
                        <a href="javascript:void(0);" data-href="{{ route('admin.course.destroy', $course->id) }}" class="px-2 red-text waves-effect pull-right perma_delete" data-method="delete" data-from="course" data-toggle="tooltip" title="Delete"><i class="fa fa-trash pr-1"></i></a>
                    </div>
                    <div class="view overlay text-white text-center pb-4">
                            <h2 class="text-uppercase card-title text-oswald">{{$course->name}}</h2>

                        <a href="{{route('admin.instructor.course', [$instructor->id, $course->id])}}" class="px-4">
                            <div class="mask rgba-white-slight">
                            </div>
                        </a>
                    </div>
                    <form id="delete-course-form-{{$course->id}}" action="{{ route('admin.course.destroy', $course->id) }}"
                        method="post">
                        @csrf {{method_field('DELETE')}}

                    </form>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
