@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h3 class="text-oswald">My Conversations</h3>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Messages -->
                        <div class="list-group">
                            @foreach ($convos as $convo)
                                
                            <a href="{{route('message.show', $convo->id)}}" class="list-group-item list-group-item-action media">
                                    {{-- <img class="mr-3 avatar-sm float-left" src="{{}}"> --}}
                                    <div class="d-flex justify-content-between mb-1 ">
                                        @if ($convo->user->id != auth()->user()->id)
                                            <hp class="mb-1"><strong>{{$convo->user->name()}}</strong></hp>
                                            <small>{{$convo->created_at->toDayDateTimeString()}}</small>
                                        @else
                                            <hp class="mb-1"><strong>{{$convo->to_user->name()}}</strong></hp>
                                            <small>{{$convo->created_at->toDayDateTimeString()}}</small>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <!-- Messages -->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
