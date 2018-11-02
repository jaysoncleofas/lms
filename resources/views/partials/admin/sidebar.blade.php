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
                    <a href="{{route('admin.dashboard')}}" class="{{Nav::isRoute('admin.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-chart-pie"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{route('admin.course.index')}}" class="{{Nav::hasSegment('course', 2)}} {{Nav::isRoute('admin.course.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Courses</a>
                </li>
                <li>
                    <a href="{{route('admin.instructor.index')}}" class="{{Nav::hasSegment('instructor', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-chalkboard-teacher"></i> Instructors</a>
                </li>
                <li>
                    <a href="{{route('admin.student.index')}}" class="{{Nav::hasSegment('student', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Students</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
