@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald text-capitalize">{{$instructor->firstName .' '.$instructor->lastName}}</h3>
        <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <h4 class="text-oswald mb-5">{{$course->name}} / Section{{count($sections) > 1 ? 's' : ''}}</h4>
        </div>
        @if ( count($sections) == 0 )
        <div class="col-xl-12 col-md-12 mb-3">
            <div class="card py-5">
                <div class="card-body text-center">
                    <h4 class="text-osald">No Section Available</h4>
                </div>
            </div>
        </div>
        @else    
            @foreach ($sections as $section)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card">
                    <div class="justify-content-between d-flex">
                        @if($section->isActive == 0)
                            <p class="my-1 mx-1 red-text"><i>Deactivated</i></p>
                        @else
                            <p class="my-1 mx-1 green-text"><i>Active</i></p>
                        @endif
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
            @endforeach
        @endif
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
