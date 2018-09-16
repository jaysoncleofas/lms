@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
        <a href="{{route('instructor.section.create', $course->id)}}" class="btn btn-primary btn-sm">Add Section</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Sections</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-lg-3">
        @foreach ($sections as $section)
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('instructor.student.index', [$course->id,$section->id])}}" class="card-title text-oswald">{{$section->name}}</a>
                    <br><br>
                    <p><i class="fa fa-users"></i> {{count($section->users)}} students</p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="{{route('instructor.section.edit', [$course->id, $section->id])}}" class="px-2 blue-text waves-effect">Edit</a>
                    <a href="#" class="px-2 red-text waves-effect" onclick="if(confirm('Are you sure you want to delete this section?')) {
                                        event.preventDefault();
                                        $('#delete-section-form-{{$section->id}}').submit();
                                      }">
                        Delete
                    </a>
                </div>
                <form id="delete-section-form-{{$section->id}}" action="{{ route('instructor.section.destroy', [$course->id, $section->id]) }}"
                    method="post">
                    @csrf {{method_field('DELETE')}}

                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
