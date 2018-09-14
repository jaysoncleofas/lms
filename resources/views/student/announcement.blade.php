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
                    <a class="breadcrumb-item" href="{{route('student.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <span class="breadcrumb-item active">Section</span>
                    <span class="breadcrumb-item active">{{$section->name}}</span>
                    <span class="breadcrumb-item active">Announcement</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-8 col-md-8 mb-5 pb-5">
                {{-- @if (count($->section) > 0) --}}
                    @foreach ($section->announcements as $announcement)
                        <div class="card mt-5">
                            <div class="card-body">
                                <!-- Newsfeed -->
                                 <div class="mdb-feed">
                                <!-- Fourth news -->
                                        <div class="news">

                                          <!-- Label -->
                                          <div class="label">
                                            <img src="{{$announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png')}}" style="height:40px;width:40px;" class="rounded-circle z-depth-1-half">
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
                                          </div>

                                        </div>
                                        <!-- Fourth news -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                {{-- @else
                    <div class="card mt-5">
                        <div class="card-body">
                            <p><i>No announcement yet</i></p>
                        </div>
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
@endsection
