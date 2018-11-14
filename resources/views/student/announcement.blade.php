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
            <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span> </h3>
            <h3 class="text-oswald font-weight-bold">Section: <span class="font-weight-normal">{{ $section->name }}</span> </h3>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-xl-8 col-md-8 mb-5 pb-5">
            <h3 class="text-oswald">Announcement{{count($section->announcements) > 1 ? 's' : ''}}</h3>
            @if (count($section->announcements) > 0)
            @foreach ($section->announcements as $announcement)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mdb-feed">
                        <div class="news">
                            <div class="label">
                                <img src="{{ $announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png') }}" style="height:30px;width:30px;object-fit:cover;" class="rounded-circle z-depth-1-half">
                            </div>
                            <div class="excerpt">
                                <div class="brief">
                                    <p class="name blue-text my-0">{{ $announcement->instructor->name() }}</p>
                                    <div class="date pl-0">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $announcement->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="added-text">
                                    {{$announcement->message}} <br>
                                </div>
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
                        </div>
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
            {{-- {{$announcements->links()}} --}}
        </div>
    </div>
</div>
@endsection
