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
                    <a href="{{route('instructor.dashboard')}}" class="{{Nav::isRoute('instructor.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Courses<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                @if (Nav::isRoute('instructor.section.index'))
                    <li>
                        <a href="{{route('instructor.section.index', $course->id)}}" class="{{Nav::isRoute('instructor.section.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Sections<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                @elseif (Nav::isRoute('instructor.section.create'))
                    <li>
                        <a href="{{route('instructor.section.index', $course->id)}}" class="{{Nav::isRoute('instructor.section.create')}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Sections<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                @elseif (Nav::isRoute('instructor.section.edit'))
                    <li>
                        <a href="{{route('instructor.section.index', $course->id)}}" class="{{Nav::isRoute('instructor.section.edit')}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Sections<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                @elseif (Nav::hasSegment('section',4))
                    <li>
                        <a href="{{route('instructor.section.index', $course->id)}}" class="{{Nav::hasSegment('sections',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Sections<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    <li>
                        <a href="{{route('instructor.announcement.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('announcement',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bullhorn"></i> Announcement<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    <li>
                        <a href="{{route('instructor.student.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('student',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-users"></i> Students<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    <li>
                        <a href="" class="{{Nav::hasSegment('student',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bookmark"></i> Lesson<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    <li>
                        <a href="" class="{{Nav::hasSegment('student',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Quiz<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    <li>
                        <a href="" class="{{Nav::hasSegment('student',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-address-book"></i> Assignment<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    <li>
                        <a href="{{route('instructor.token.index', [$course->id, $section->id])}}" class="{{Nav::isRoute('instructor.token.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-adn"></i> Token<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                @endif

                {{-- <li>
                    <a href="" class="{{Nav::isRoute('instructor.section.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-tachometer"></i> Lesson<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="" class="{{Nav::isRoute('instructor.section.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-tachometer"></i> Quiz<i class="fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="" class="{{Nav::isRoute('instructor.section.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-tachometer"></i> Assignment<i class="fa fa-angle-right pull-right"></i></a>
                </li> --}}
            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
<!--/. Sidebar navigation -->
