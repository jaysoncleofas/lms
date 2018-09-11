<!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav navbar-light bg-white">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a id="slide-out-burger" href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                    <a class="navbar-brand text-oswald" href="#" style="font-size:19px;">Learning Management System </a>
                {{-- <p>Learning Management System</p> --}}
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{$user->avatar ? asset('storage/avatars/'.$user->avatar) : asset('images/profile_pic.png')}}" class="rounded-circle z-depth-1" style="height:30px;width:30px;" alt=""> <span class="clearfix d-none d-sm-inline-block">{{Auth::user()->firstName.' '.Auth::user()->lastName}}</span>
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
