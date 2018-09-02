@extends('layouts.app')

@section('styles')
    <style media="screen">
        .mdb-feed {
            margin: 0 !important
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">{{$course->name}}</a>
                    <a class="breadcrumb-item" href="{{route('instructor.section.index', $course->id)}}">Sections</a>
                    <span class="breadcrumb-item active">{{$section->name}}</span>
                    <span class="breadcrumb-item active">Announcement</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-6 col-md-6 mb-5 pb-5">
                <a class="comment" data-toggle="collapse" href="#collapseExample-4" aria-expanded="false" aria-controls="collapseExample-4">Update Announcement</a>
                <div class="card mt-5">
                    <div class="card-body">
                        <form class="" action="{{route('instructor.announcement.update', [$course->id, $section->id, $announcement->id])}}" method="post">
                            {{ csrf_field() }} {{method_field('PUT')}}
                            <!-- Add comment -->
                            <div class="md-form mt-1 mb-1">
                              <textarea type="text" id="form7" name="content" class="form-control md-textarea {{$errors->has('content') ? 'is-invalid' : ''}}" rows="3">{{$announcement->content}}</textarea>
                              <label for="form7">Message</label>
                              @if ($errors->has('content'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('content') }}</strong>
                                  </span>
                              @endif
                            </div>
                            <div class="d-flex justify-content-end">
                              <a href="{{route('instructor.announcement.index', [$course->id, $section->id])}}" class="btn btn-flat waves-effect">Cancel</a>
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
