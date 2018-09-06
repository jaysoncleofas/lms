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
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <span class="breadcrumb-item active">Announcement</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-8 col-md-8 mb-5 pb-5">
                <a href="{{route('instructor.announcement.create', $course->id)}}" class="comment">Write Announcement</a>
                {{-- <div class="collapse {{$errors->has('content') ? 'show' : ''}}" id="collapseExample-4">
                  <div class="card card-body mt-1">
                    <form class="" action="{{route('instructor.announcement.store', $course->id)}}" method="post">
                        {{ csrf_field() }}
                        <!-- Add comment -->
                        <div class="md-form mt-1 mb-1">
                          <textarea type="text" id="form7" name="content" class="form-control md-textarea {{$errors->has('content') ? 'is-invalid' : ''}}" rows="3">{{old('content')}}</textarea>
                          <label for="form7">Message</label>
                          @if ($errors->has('content'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('content') }}</strong>
                              </span>
                          @endif
                        </div>
                        <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-flat waves-effect" data-toggle="collapse" data-target="#collapseExample-4" aria-expanded="false" aria-controls="collapseExample-4">Cancel</button>
                          <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                  </div>
                </div> --}}

                @if (count($announcements) > 0)
                    @foreach ($announcements as $announcement)
                        <div class="card mt-5">
                            <div class="card-body">
                                <!-- Newsfeed -->
                                 <div class="mdb-feed">
                                <!-- Fourth news -->
                                        <div class="news">

                                          <!-- Label -->
                                          <div class="label">
                                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(18)-mini.jpg" class="rounded-circle z-depth-1-half">
                                          </div>

                                          <!-- Excerpt -->
                                          <div class="excerpt">
                                            <!-- Brief -->
                                            <div class="brief">
                                              <a class="name">{{$announcement->instructor->firstName.' '.$announcement->instructor->lastName}}</a>
                                              <div class="date"><i class="fa fa-clock-o"></i> {{$announcement->created_at->diffForHumans()}}</div>
                                            </div>
                                            <!-- Added text -->
                                            <div class="added-text">{{$announcement->content}}</div>

                                            <p>Posted to:
                                                @foreach ($announcement->sections as $section)
                                                    {{$section->name}},
                                                @endforeach
                                            </p>
                                            <!-- Feed footer -->
                                            <div class="feed-footer">
                                              <a href="{{route('instructor.announcement.edit', [$course->id, $announcement->id])}}" class="thumbs mr-3">
                                                <i class="fa fa-edit blue-text"></i> Edit
                                              </a>
                                              <a class="thumbs" onclick="if(confirm('Are you sure you want to delete this announcement?')) {
                                                          event.preventDefault();
                                                          $('#delete-announcement-form-{{$announcement->id}}').submit();
                                                        }">
                                                <i class="fa fa-trash red-text"></i> Delete
                                              </a>
                                              <form id="delete-announcement-form-{{$announcement->id}}" action="{{ route('instructor.announcement.destroy', [$course->id, $announcement->id]) }}" method="post">
                                                @csrf {{method_field('DELETE')}}

                                              </form>
                                            </div>
                                          </div>

                                        </div>
                                        <!-- Fourth news -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card mt-5">
                        <div class="card-body">
                            <p><i>No announcement yet</i></p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
