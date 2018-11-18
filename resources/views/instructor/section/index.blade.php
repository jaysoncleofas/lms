@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <a href="{{route('instructor.section.create', $course->id)}}" class="btn btn-primary my-0 mr-0"><i class="fa fa-plus"></i> Add Section</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-graduation-cap fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Section{{count($sections) > 1 ? 's' : ''}}</h2>
                    <a href="{{route('instructor.section.index', $course->id)}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-minus-circle fa-3x tiles-left-icon"></i>
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
    <hr class="mb-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Active Section{{count($sections) > 1 ? 's' : ''}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
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
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body justify-content-between d-flex">
                        <a href="{{route('instructor.section.edit', [$course->id, $section->id])}}" class="px-2 pull-left blue-text waves-effect" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil pr-1"></i></a>
                        <a  href="javascript:void(0);" data-href="{{ route('instructor.section.status', [$course->id, $section->id]) }}" class="deactivate px-2 red-text waves-effect pull-right" data-method="put" data-from="section" data-action="deactivate" data-value="0" data-toggle="tooltip" title="Deactivate"><i class="fa fa-trash pr-1"></i></a>
                    </div>
                    <div class="view overlay text-white text-center pb-4">
                        <h2 class="text-uppercase card-title text-oswald">{{$section->name}}</h2>
                        <h2 class="text-uppercase text-oswald">{{count($section->users)}} <i class="fa fa-users"></i> </h2>
                        <a href="{{route('instructor.student.index', [$course->id,$section->id])}}" class="px-4">
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
