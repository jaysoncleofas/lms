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
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-xl-8 col-md-8 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Announcement{{count($announcements) > 1 ? 's' : ''}}</h3>
                <a href="{{route('instructor.announcement.create', $course->id)}}" class="btn btn-primary">Post</a>
            </div>

            @if (count($announcements) > 0)
            @foreach ($announcements as $announcement)
            <div class="card my-3">
                <div class="card-body">
                    <!-- Newsfeed -->
                    <div class="mdb-feed">
                        <!-- Fourth news -->
                        <div class="news">

                            <!-- Label -->
                            <div class="label">
                                <img src="{{$announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png')}}" class="rounded-circle z-depth-1" style="height:30px;width:30px;" alt="">
                            </div>

                            <!-- Excerpt -->
                            <div class="excerpt">
                                <!-- Brief -->
                                <div class="brief">
                                    <p class="name blue-text my-0">{{$announcement->instructor->firstName.' '.$announcement->instructor->lastName}}</p>
                                    <div class="date pl-0">
                                        <i class="fa fa-clock-o"></i>
                                        {{$announcement->created_at->diffForHumans()}}
                                    </div>
                                    <div class="pull-right mb-3">
                                        <a href="{{route('instructor.announcement.edit', [$course->id, $announcement->id])}}" class="thumbs mr-3 black-text" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <i class="fa fa-pencil blue-text"></i>
                                        </a>
                                        <a class="thumbs" onclick="if(confirm('Are you sure you want to delete this announcement?')) {
                                                                event.preventDefault();
                                                                $('#delete-announcement-form-{{$announcement->id}}').submit();
                                                            }" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                            <i class="fa fa-trash red-text"></i>
                                        </a>
                                        <form id="delete-announcement-form-{{$announcement->id}}" action="{{ route('instructor.announcement.destroy', [$course->id, $announcement->id]) }}" method="post">
                                            @csrf {{method_field('DELETE')}}
    
                                        </form>
                                    </div>
                                </div>
                                <!-- Added text -->
                                <div class="added-text">
                                    {{$announcement->message}} <br>
                                    <img class="z-depth-1 img-fluid mt-3" src="{{asset('storage/images/'.$announcement->image)}}" alt="">
                                </div>

                                <p class="my-0">Posted to:
                                    @foreach ($announcement->sections as $section)
                                    {{$section->name}},
                                    @endforeach
                                </p>
                            </div>

                        </div>
                        <!-- Fourth news -->
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="card my-5">
                <div class="card-body">
                    <p><i>No announcement yet</i></p>
                </div>
            </div>
            @endif
            {{$announcements->links()}}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
