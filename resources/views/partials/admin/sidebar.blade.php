<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <li>
            <div class="logo-wrapper waves-light">
                <img style="height:50px;width:50px;padding:5px;margin-top:15px;" src="{{ asset('images/ccs.png') }}" alt=""> 
                <p style="margin-top:13px;color:black;padding-top:15px;font-size:16px;position:absolute;top:0;left:54px;">Learning Management System</p>
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
