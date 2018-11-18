@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <a href="{{ route('instructor.quiz.create', $course->id) }}" class="btn btn-primary my-0 mr-0"><i class="fa fa-plus"></i> Add Quiz</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-book fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($quizzes)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Quiz{{count($quizzes) > 1 ? 'zes' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Section</th>
                                <th>Questions</th>
                                <th>Time Limit</th>
                                <th>Start Date</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $key => $quiz)
                            <tr>
                                <td>{{ $key+1 }}.</td>
                                <td>
                                    @if (!$quiz->isCode)
                                        <a href="{{ route('instructor.question.index', [$course->id, $quiz->id]) }}" class="btn-link" title="{{ $quiz->title }}">
                                            {{ substr($quiz->title, 0, 20) }}{{ strlen($quiz->title) > 20 ? "..." : "" }}
                                        </a>
                                    @else 
                                        <a href="{{ route('instructor.quiz.show', [$course->id, $quiz->id]) }}" class="btn-link" title="{{ $quiz->title }}">
                                            <strong>{{ $quiz->isCode ? 'Code:' : '' }}</strong> {{ substr($quiz->title, 0, 20) }}{{ strlen($quiz->title) > 20 ? "..." : "" }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($quiz->sections as $key => $section2)
                                        {{ $section2->name }}{{ $key < count($quiz->sections) - 1 ? ', ' : ''  }}
                                    @endforeach
                                </td>
                                <td>
                                    @if (!$quiz->isCode)
                                        <a href="{{route('instructor.question.create', [$course->id, $quiz->id])}}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Add Question" data-placement="right">{{count($quiz->questions)}}</a>
                                    @endif
                                </td>
                                <td>{{$quiz->timeLimit ?? 0}} minutes</td>
                                <td>{{$quiz->startDate ? $quiz->startDate->toFormattedDateString() : ''}}</td>
                                <td>{{ $quiz->expireDate ? $quiz->expireDate->toFormattedDateString() : ''}}</td>
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.quiz.status', [$course->id, $quiz->id]) }}" class="deactivate btn btn-sm {{ $quiz->isActive == 1 ? 'btn-success' : 'btn-warning'  }}" data-method="put" data-from="token" data-action="{{ $quiz->isActive == 1 ? 'deactivate' : 'activate' }}" data-from="token" data-value="{{ $quiz->isActive == 1 ? 0 : 1  }}">
                                        @if ($quiz->isActive == 1) 
                                            Active
                                        @else 
                                            Inactive
                                        @endif    
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('instructor.quiz.edit', [$course->id, $quiz->id]) }}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a> 
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.quiz.destroy', [$course->id, $quiz->id]) }}" class="perma_delete text-danger" data-placement="left" data-method="delete" data-from="quiz" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/addons/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order:[]
        });
    });
</script>
@endsection
