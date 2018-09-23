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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-oswald">Messages</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="">
                                    @foreach ($messages as $message) 
                                    <div class="text-center"><small>{{$message->created_at->toDayDateTimeString()}}</small></div>
                                        @if ($message->user_id != auth()->user()->id)
                                        <div class="d-flex justify-content-start media">
                                            <!-- Avatar -->
                                            <img class="img-fluid rounded-circle z-depth-1 mr-2" style="height:50px;width:50px;" src="{{$message->user->photo ? '' : asset('images/profile_pic.png')}}">
            
                                                <p class="grey lighten-3 rounded p-3 w-75"><strong>{{$message->user->name()}}:</strong> {{$message->message}}</p>
                                        </div>

                                        @else 
                                            {{-- <div class="text-left"><small>{{$message->created_at->toDayDateTimeString()}}</small></div> --}}
                                            <div class="d-flex justify-content-end">
                                                <p class="primary-color white-text rounded p-3 grey-white w-75 ">
                                                    {{$message->message}}
                                                </p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>  
                        <!-- New message -->
                        <form action="{{route('message.reply', $conversation->id)}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                
                                <div class="d-flex flex-row">
                                    <div class="md-form chat-message-type">
                                        <textarea type="text" id="message" name="message" class="md-textarea form-control" rows="3"></textarea>
                                        <label for="message">Type your message</label>
                                    </div>

                                    <div class="mt-5">
                                        <button class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                         </form>
                        <!-- /.New message -->                          
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
