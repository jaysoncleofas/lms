<!-- Sidebar navigation -->
<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <!-- Logo -->
        <li>
            <div class="logo-wrapper waves-light">
                <a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center img-logo"></a>
            </div>
        </li>
        <!--/. Logo -->
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="{{route('admin.dashboard')}}" class="{{Nav::isRoute('admin.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-tachometer"></i> Dashboard<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.course.index')}}" class="{{Nav::hasSegment('course', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Course<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="{{route('admin.instructor.index')}}" class="{{Nav::hasSegment('instructor', 2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Instructors<i class="fa fa-angle-right pull-right"></i></a>
                </li>
            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
<!--/. Sidebar navigation -->
