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
        <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span> </h3>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-8 col-md-10 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Announcement{{count($announcements) > 1 ? 's' : ''}}</h3>
                <a href="{{route('instructor.announcement.create', $course->id)}}" class="btn btn-primary"><i class="fa fa-share-square"></i> Post</a>
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
                                <img src="{{$announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png')}}" class="rounded-circle z-depth-1" style="height:30px;width:30px;object-fit:cover;" alt="">
                            </div>

                            <!-- Excerpt -->
                            <div class="excerpt">
                                <!-- Brief -->
                                <div class="brief">
                                    <p class="name blue-text my-0">{{ $announcement->instructor->name() }}</p>
                                    <div class="date pl-0">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $announcement->created_at->diffForHumans() }}
                                    </div>
                                    <div class="float-right mb-3">
                                        <a href="{{route('instructor.announcement.edit', [$course->id, $announcement->id])}}" class="thumbs mr-3 black-text" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <i class="fa fa-pencil-alt blue-text"></i>
                                        </a>
                                        
                                        <a class="thumbs perma_delete" href="javascript:void(0);" data-href="{{ route('instructor.announcement.destroy', [$course->id, $announcement->id]) }}" data-method="delete" data-from="announcement" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                            <i class="fa fa-trash red-text"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Added text -->
                                <div class="added-text">
                                    {{$announcement->message}} 
                                    @if ($announcement->image)
                                        <br>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#basicExampleModal{{ $announcement->id }}">
                                            <img id="img-announcement" class="z-depth-1 mt-3" src="{{asset('storage/images/'.$announcement->image)}}" style="height:500px; width:100%; object-fit:cover;" alt="">
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="basicExampleModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $announcement->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img class="z-depth-1 img-fluid mt-3" src="{{asset('storage/images/'.$announcement->image)}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <p class="my-0">Posted to:
                                    @foreach ($announcement->sections as $key => $section)
                                        {{$section->name}}{{ $key < count($announcement->sections) - 1 ? ', ' : ''  }}
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
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
@include('partials.notification')
@endsection
