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
                        <a href="{{route('student.dashboard')}}" class="{{Nav::hasSegment('dashboard',2)}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Courses<i class="fa fa-angle-right pull-right"></i></a>
                    </li>
                    @if (Nav::hasSegment('section', 4))
                        <li>
                            <a href="{{route('student.section.index', [$course->id, $section->id])}}" class="{{Nav::isRoute('student.section.index')}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Section<i class="fa fa-angle-right pull-right"></i></a>
                        </li>
                        <li>
                            <a href="{{route('student.announcement', [$course->id, $section->id])}}" class="{{Nav::hasSegment('announcement',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bullhorn"></i> Announcement<i class="fa fa-angle-right pull-right"></i></a>
                        </li>
                        <li>
                            <a href="{{route('student.lesson.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('lesson',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bookmark"></i> Lesson<i class="fa fa-angle-right pull-right"></i></a>
                        </li>
                        <li>
                            <a href="{{route('student.quiz.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('quiz',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Quiz<i class="fa fa-angle-right pull-right"></i></a>
                        </li>
                        <li>
                            <a href="{{route('student.assignment.index', [$course->id, $section->id])}}" class="{{Nav::hasSegment('assignment',6)}} collapsible-header waves-effect arrow-r"><i class="fa fa-address-book"></i> Assignment<i class="fa fa-angle-right pull-right"></i></a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
        <div class="sidenav-bg mask-strong"></div>
    </div>
