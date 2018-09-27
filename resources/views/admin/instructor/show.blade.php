@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald text-capitalize">{{$instructor->firstName .' '.$instructor->lastName}}</h3>
        <a href="{{ route('admin.instructor.index') }}" class="btn btn-danger">Back</a>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-12">
            <h4 class="text-oswald mb-5">Course{{count($instructor->courses) > 1 ? 's' : ''}}</h4>
        </div>
        @if ( count($instructor->courses) == 0 )
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card py-5">
                <div class="card-body text-center">
                    <h4 class="text-osald">No Section Available</h4>
                </div>
            </div>
        </div>
        @else    
            @foreach ($instructor->courses as $course)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body justify-content-between d-flex">
                        <a href="{{route('admin.course.edit', $course->id)}}" class="px-2 pull-left blue-text waves-effect"><i class="fa fa-pencil pr-1"></i></a>
                        <a href="#" class="px-2 red-text waves-effect pull-right" onclick="if(confirm('Are you sure you want to delete this course?')) {
                            event.preventDefault();
                            $('#delete-course-form-{{$course->id}}').submit();
                        }"><i class="fa fa-trash pr-1"></i></a>
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
