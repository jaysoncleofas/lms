@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h3 class="text-oswald">My messages</h3>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Messages -->
                        <div class="list-group">
                            @foreach ($convos as $convo)
                                {{$convo->user->firstName}}
                                <a href="#" class="list-group-item list-group-item-action media">
                                    <img class="mr-3 avatar-sm float-left" src="https://secure.gravatar.com/avatar/8c051fd54e4c811e02bbc78d50549280?s=150&amp;d=mm&amp;r=g">
                                    <div class="d-flex justify-content-between mb-1 ">
                                        <hp class="mb-1"><strong>Michal Szymanski</strong></hp>
                                        <small>14 July</small>
                                    </div>
                                    <p class="text-truncate"><span class="badge red">MDB Team</span> <strong>Michal: </strong> Donec id elit non
                                        mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
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
