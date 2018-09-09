@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <span class="breadcrumb-item active">Sections</span>
                    <a href="{{route('instructor.section.create', $course->id)}}" class="breadcrumb-item"><i class="fa fa-plus"></i> Add</a>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                {{-- <div class="card">
                    <header>
                        <div class="card-header indigo white-text text-center">
                            Add Section
                        </div>
                    </header>
                    <div class="card-body text-center" style="padding: 48px;">
                        <a href="{{route('instructor.section.create', $course->id)}}" class="btn-floating peach-gradient"><i class="fa fa-plus"></i></a>
                    </div>
                </div> --}}
            </div>
            @foreach ($sections as $section)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card">
                        {{-- <img class="img-fluid" src="{{asset('images/book.jpg')}}" alt="Card image cap"> --}}
                        <div class="card-body">
                            <!--Title-->
                            <a href="{{route('instructor.student.index', [$course->id,$section->id])}}" class="card-title">{{$section->name}}</a>
                            {{-- <hr> --}}<br><br>
                            <p><i class="fa fa-users"></i> {{count($section->users)}} students</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{route('instructor.section.edit', [$course->id, $section->id])}}" class="px-2 blue-text waves-effect">Edit</a>
                            <a href="#" class="px-2 red-text waves-effect"onclick="if(confirm('Are you sure you want to delete this section?')) {
                                        event.preventDefault();
                                        $('#delete-section-form-{{$section->id}}').submit();
                                      }">
                                Delete
                            </a>
                        </div>
                        <form id="delete-section-form-{{$section->id}}" action="{{ route('instructor.section.destroy', [$course->id, $section->id]) }}" method="post">
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
