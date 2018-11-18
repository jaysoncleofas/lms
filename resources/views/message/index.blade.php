@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>My Conversations</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="list-group">
                            @forelse ($convos as $convo)
                                <a href="{{ route('message.show', $convo->id) }}" class="list-group-item list-group-item-action media">
                                    @if ($convo->to_user_id == auth()->user()->id)
                                        <img class="img-fluid rounded-circle z-depth-1 mr-3 avatar-sm float-left" style="object-fit:cover;height:50px;width:50px;" src="{{ $convo->user->avatar ? asset('storage/avatars/'.$convo->user->avatar)  : asset('images/profile_pic.png') }}">
                                        <div class="d-flex justify-content-between mb-1 ">
                                            <p class="mb-1"><strong>{{ $convo->user->name() }}</strong> <br>
                                                {{ $convo->getLatestMessage()->user_id == auth()->user()->id ? 'You:' : '' }} 
                                                {{ substr($convo->getLatestMessage()->message, 0, 100) }}{{ strlen($convo->getLatestMessage()->message) > 100 ? "..." : "" }}
                                            </p>
                                            <small>{{ $convo->getLatestMessage()->created_at->toDayDateTimeString() }}</small>
                                        </div>
                                    @else
                                        <img class="img-fluid rounded-circle z-depth-1 mr-3 avatar-sm float-left" style="object-fit:cover;height:50px;width:50px;" src="{{ $convo->to_user->avatar ? asset('storage/avatars/'.$convo->to_user->avatar)  : asset('images/profile_pic.png') }}">
                                        <div class="d-flex justify-content-between mb-1 ">
                                            <p class="mb-1"><strong>{{ $convo->to_user->name() }}</strong> <br>
                                                {{ $convo->getLatestMessage()->user_id == auth()->user()->id ? 'You:' : '' }} 
                                                {{ substr($convo->getLatestMessage()->message, 0, 100) }}{{ strlen($convo->getLatestMessage()->message) > 100 ? "..." : "" }}
                                            </p>
                                            <small>{{ $convo->getLatestMessage()->created_at->toDayDateTimeString() }}</small>
                                        </div>
                                    @endif
                                </a>
                            @empty
                                <div>
                                    <p><i>No conversation available</i></p>
                                </div>
                            @endforelse
                        </div>
                        {{ $convos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
