<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <li>
            <div class="logo-wrapper waves-light">
                {{-- <a href="#"><img src="{{asset('images/logo.png')}}" class="img-fluid flex-center img-logo"></a> --}}
                <a class="navbar-brand text-oswald black-text" href="#" style="font-size:19px;padding-left: 15px;">Learning Management System </a>
            </div>
        </li>
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="{{route('admin.dashboard')}}" class="{{Nav::isRoute('admin.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-tachometer"></i> Dashboard<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.course.index')}}" class="{{Nav::isResource('course', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Courses<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.instructor.index')}}" class="{{Nav::hasSegment('instructor', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Instructors<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.student.index')}}" class="{{Nav::hasSegment('student', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Students<i class="fa fa-angle-right pull-right"></i></a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
