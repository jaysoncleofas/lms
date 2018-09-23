@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
        <a href="{{route('instructor.section.create', $course->id)}}" class="btn btn-primary">Add Section</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                        <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections)}}</strong></h2>
                        <h2 class="text-uppercase text-white text-oswald">Section{{count($sections) > 1 ? 's' : ''}}</h2>
                    <a href="{{route('instructor.section.index', $course->id)}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                        <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections2)}}</strong></h2>
                        <h2 class="text-uppercase text-white text-oswald">Deactivated Section{{count($sections2) > 1 ? 's' : ''}}</h2>
                    <a href="{{route('instructor.section.deactivated', $course->id)}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-12">
            <h4 class="text-oswald mb-5">Active</h4>
        </div>
        @if ( count($sections) == 0 )
        <div class="col-xl-12 col-md-12 mb-4">
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
                    <div class="card-body justify-content-between d-flex">
                        <a href="{{route('instructor.section.edit', [$course->id, $section->id])}}" class="px-2 pull-left blue-text waves-effect"><i class="fa fa-pencil pr-1"></i></a>
                        <a href="#" class="px-2 red-text waves-effect pull-right" onclick="if(confirm('Are you sure you want to deactivate this section?')) {
                            event.preventDefault();
                            $('#deactivate-form-{{$section->id}}').submit();
                        }"><i class="fa fa-trash pr-1"></i></a>
                    </div>
                    <div class="view overlay text-white text-center pb-4">
                            <h2 class="text-uppercase card-title text-oswald">{{$section->name}}</h2>
                            <h2 class="text-uppercase text-oswald">{{count($section->users)}} student{{count($section->users) > 1 ? 's' : ''}}</h2>
                        <a href="{{route('instructor.student.index', [$course->id,$section->id])}}" class="px-4">
                            <div class="mask rgba-white-slight">
                            </div>
                        </a>
                    </div>
                    
                    <form id="deactivate-form-{{$section->id}}" action="{{ route('instructor.section.status', [$course->id, $section->id]) }}"
                            method="post">
                            @csrf {{method_field('PUT')}}
                            <input type="hidden" name="status" value="0">
                            </form>
                    <form id="delete-section-form-{{$section->id}}" action="{{ route('instructor.section.destroy', [$course->id, $section->id]) }}"
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
