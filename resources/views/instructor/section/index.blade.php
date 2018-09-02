@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-lg-5">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">{{$course->name}}</a>
                    <span class="breadcrumb-item active">Sections</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card">
                    <header>
                        <div class="card-header indigo white-text text-center">
                            Add Section
                        </div>
                    </header>
                    <div class="card-body text-center" style="padding: 48px;">
                        <a href="{{route('instructor.section.create', $course->id)}}" class="btn-floating peach-gradient"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            @foreach ($sections as $section)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card">
                        <img class="img-fluid" src="{{asset('images/book.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <!--Title-->
                            <a href="{{route('instructor.announcement.index', [$course->id,$section->id])}}" class="card-title">{{$section->name}}</a>
                            <hr>
                            <a href="{{route('instructor.section.edit', [$course->id, $section->id])}}" class="btn btn-outline-primary btn-sm px-2 waves-effect"><i class="fa fa-edit"></i>Edit</a>
                            <a href="#" class="btn btn-outline-danger btn-sm px-2 waves-effect"onclick="if(confirm('Are you sure you want to delete this section?')) {
                                        event.preventDefault();
                                        $('#delete-section-form-{{$section->id}}').submit();
                                      }">
                                <i class="fa fa-trash"></i>Delete
                            </a>
                            <form id="delete-section-form-{{$section->id}}" action="{{ route('instructor.section.destroy', [$course->id, $section->id]) }}" method="post">
                              @csrf {{method_field('DELETE')}}

                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
