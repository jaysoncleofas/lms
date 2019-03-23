<!-- Navbar -->
<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav navbar-light bg-white">
    <!-- SideNav slide-out button -->
    <div class="float-left">
        <a id="slide-out-burger" href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
    </div>
    <!-- Breadcrumb-->
    <div class="breadcrumb-dn mr-auto">
        <a class="navbar-brand text-oswald" href="/{{ Auth::user()->role }}/{{ Auth::user()->role == 'instructor' ? 'course' : 'dashboard' }}" style="font-size:19px;">
            <img style="height:35px;" src="{{ asset('images/ccs.png') }}" alt="">
            Learning Management System 
        </a>
    </div>
    <ul class="nav navbar-nav nav-flex-icons ml-auto">
        <li class="nav-item">
            <a href="{{route('my_files')}}" class="nav-link" data-toggle="tooltip" data-placement="bottom" title="Files"><i class="fa fa-file"></i> </a>
        </li>
        @if(auth()->user()->role != 'admin')
        <notification :userid="{{ auth()->id() }}" :unreads="{{ auth()->user()->unreadnotifications }}"></notification>
        {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope"></i> 
                @if (auth()->user()->unreadnotifications->count())
                    <span class="badge badge-danger">{{ auth()->user()->unreadnotifications->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink" style="width:358px !important;right:-74px;{{ auth()->user()->unreadnotifications->count() > 5 ? 'height:500px;overflow-y:scroll' : 'height:auto;overflow-y:hidden' }}">
                @if (auth()->user()->unreadnotifications->count())
                    <a class="dropdown-item" href="{{ route('markAsAllRead') }}">Mark as All Read</a>
                @endif
                @foreach (auth()->user()->unreadnotifications as $notification)
                    <a class="dropdown-item unread" href="javascript:void(0)" data-href="{{ route('markAsRead') }}" data-value="{{ $notification->id }}" data-convo="{{ $notification->data['convo_id'] }}">
                        <div class="row">
                            <div class="col-3 text-center">
                                <img src="{{ \App\User::find($notification->data['user_id'])->avatar ? asset('storage/avatars/'.\App\User::find($notification->data['user_id'])->avatar) : asset('images/profile_pic.png') }}" class="img-fluid rounded-circle z-depth-1" style="height:30px;width:30px;object-fit: cover;" alt="">
                            </div>
                            <div class="col-8 pl-0 pr-0">
                                <div class="row justify-content-between">
                                    <strong>{{ \App\User::find($notification->data['user_id'])->name() }}</strong>
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                                <div class="row">
                                    {{ substr( $notification->data['message'], 0, 40) }}{{ strlen( $notification->data['message']) > 40 ? "..." : "" }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <a class="dropdown-item" href="{{route('message.index')}}">See All</a>
            </div>
        </li> --}}
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ Auth::user()->avatar ? asset('storage/avatars/'.Auth::user()->avatar) : asset('images/profile_pic.png') }}" class="img-fluid rounded-circle z-depth-1" style="height:30px;width:30px;object-fit: cover;" alt=""> <span class="clearfix d-none d-sm-inline-block">{{ Auth::user()->name() }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{route('profile.index')}}">Profile</a>
                <a class="dropdown-item" href="{{route('change.password.index')}}">Change Password</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </div>
        </li>
    </ul>
</nav>
<!-- /.Navbar -->
