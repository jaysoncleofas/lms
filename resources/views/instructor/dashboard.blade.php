@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Courses</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-3">
        @foreach (Auth::user()->courses as $course)
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="post-prev-title">
                            <h3><a href="{{ route('instructor.section.index', $course->id) }}">{{ $course->name }}</a></h3>
                        </div>
                        <div class="post-prev-info">
                            {{ $course->code }}
                        </div>
                        <div class="post-prev-text">
                            {{ substr($course->description, 0, 195) }}{{ strlen($course->description) > 195 ? "..." : "" }}
                        </div>
                        <hr>
                        <div class="">
                            <a href="{{ route('instructor.section.index', $course->id) }}" class="blog-more">VIEW MORE</a>
                            <div class="float-right">
                                <a href="javascript:void(0);" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Instructors">
                                    <span class="icon_comment_alt">
                                        <i class="fa fa-users"></i>
                                    </span>
                                    <span class="icon-count">{{ count($course->users) }}</span>
                                </a>

                                <a href="javascript:void(0);" class="post-prev-count" data-toggle="tooltip" data-placement="top" title="Sections">
                                    <span class="icon_comment_alt">
                                        <i class="fa fa-graduation-cap"></i>
                                    </span>
                                    <span class="icon-count">{{ count($course->sections) }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
