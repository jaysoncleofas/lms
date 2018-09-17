<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <li>
            <div class="logo-wrapper waves-light">
                <a href="#"><img src="{{asset('images/logo.png')}}" class="img-fluid flex-center img-logo"></a>
            </div>
        </li>
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="{{route('admin.dashboard')}}" class="{{Nav::isRoute('admin.dashboard')}} collapsible-header waves-effect arrow-r"><i
                            class="fa fa-tachometer"></i> Dashboard<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.course.index')}}" class="{{Nav::hasSegment('course', 2)}} collapsible-header waves-effect arrow-r"><i
                            class="fa fa-book"></i> Course<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.instructor.index')}}" class="{{Nav::hasSegment('instructor', 2)}} collapsible-header waves-effect arrow-r"><i
                            class="fa fa-users"></i> Instructors<i class="fa fa-angle-right pull-right"></i></a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
