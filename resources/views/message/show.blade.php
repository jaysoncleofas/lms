@extends('layouts.app')

@section('styles')
    <style>
        .chat-message-type{
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>Messages</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-lg-8">
                <h5 class="text-oswald text-left">{{ $conversation->to_user_id != auth()->user()->id ? $conversation->to_user->name() : $conversation->user->name() }}</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="">
                                    @foreach ($messages as $message)
                                        @if ($message->user_id != auth()->user()->id)
                                            <div class="d-flex justify-content-start media">
                                                <img class="img-fluid rounded-circle z-depth-1 mr-2" style="object-fit:cover;height:50px;width:50px;" src="{{$message->user->avatar ? asset('storage/avatars/'.$message->user->avatar) : asset('images/profile_pic.png')}}">
                                                <p class="grey lighten-3 rounded p-3 w-75" data-toggle="tooltip" title="{{ $message->created_at->toDayDateTimeString() }}" data-placement="right"> {{$message->message}}</p>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-end">
                                                <p class="primary-color white-text rounded p-3 grey-white w-75" data-toggle="tooltip" title="{{ $message->created_at->toDayDateTimeString() }}" data-placement="left">
                                                    {{$message->message}}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <form action="{{route('message.reply', $conversation->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <hr class="mb-0">
                                    <div class="d-flex flex-row">
                                        <div class="md-form chat-message-type">
                                            <textarea type="text" id="message" name="message" class="md-textarea form-control" rows="3" required></textarea>
                                            <label for="message">Type your message</label>
                                        </div>
                                        <div class="mt-5">
                                            <button class="btn btn-primary"> Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
