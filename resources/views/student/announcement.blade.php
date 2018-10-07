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
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-xl-8 col-md-8 mb-5 pb-5">
            @if (count($section->announcements) > 0)
            @foreach ($section->announcements as $announcement)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mdb-feed">
                        <div class="news">
                            <div class="label">
                                <img src="{{$announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png')}}" style="height:40px;width:40px;" class="rounded-circle z-depth-1-half">
                            </div>
                            <div class="excerpt">
                                <div class="brief">
                                    <p class="name blue-text my-0">{{$announcement->instructor->firstName.' '.$announcement->instructor->lastName}}</p>
                                    <div class="date pl-0"><i class="fa fa-clock-o"></i>
                                        {{$announcement->created_at->diffForHumans()}}</div>
                                </div>
                                <div class="added-text">
                                    {{$announcement->message}}
                                    <img class="z-depth-1 img-fluid mt-3" src="{{asset('storage/images/'.$announcement->image)}}" alt="">
                                </div>
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
