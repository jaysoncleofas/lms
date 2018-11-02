<div id="slide-out" class="side-nav side-nav-light fixed">
    <ul class="custom-scrollbar">
        <li>
            <div class="waves-light">
                <a class="navbar-brand text-oswald black-text" href="#" style="font-size:19px;padding-left: 15px;">Learning Management System </a>
            </div>
        </li>
        <li>
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a href="{{route('instructor.dashboard')}}" class="{{Nav::isRoute('instructor.dashboard')}} collapsible-header waves-effect arrow-r"><i class="fa fa-list"></i> Course</a>
                </li>

                @if (Nav::hasSegment('course', 2))
                    <li>
                        <a href="{{route('instructor.section.index', $course->id)}}" class="{{Nav::hasSegment('section',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-graduation-cap"></i> Section</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.announcement.index', $course->id)}}" class="{{Nav::hasSegment('announcement',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bullhorn"></i> Announcement</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.lesson.index', $course->id)}}" class="{{Nav::hasSegment('lesson',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-bookmark"></i> Lesson</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.quiz.index', $course->id)}}" class="{{Nav::hasSegment('quiz',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i> Quiz</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.assignment.index', $course->id)}}" class="{{Nav::hasSegment('assignment',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-address-book"></i> Assignment</a>
                    </li>
                    <li>
                        <a href="{{route('instructor.token.index', $course->id)}}" class="{{Nav::hasSegment('token',4)}} collapsible-header waves-effect arrow-r"><i class="fa fa-key"></i> Token</a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
