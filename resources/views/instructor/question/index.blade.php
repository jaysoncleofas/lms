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
            <a href="{{ route('instructor.question.create', [$course->id, $quiz->id]) }}" class="btn btn-primary my-0 mr-0"><i class="fa fa-plus"></i> Add Question</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-{{ !$quiz->isCode ? 'question' : 'clipboard-list' }} fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($questions)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">{{ !$quiz->isCode ? 'Question' : 'Item' }}{{count($questions) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-2">
    <div class="row mt-0">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $quiz->isCode ? "Code " : '' }}Quiz: {{$quiz->title}}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-3">
            <div class="card">
                {{-- <div class="card-header">
                    <h5 class="text-oswald mb-0 font-weight-bold">{{ $quiz->isCode ? "Code " : '' }}Quiz: <span class="font-weight-normal">{{$quiz->title}}</span></h5>
                </div> --}}
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ !$quiz->isCode ? "Questions" : 'Items' }}</th>
                                <th>Image</th>
                                @if (!$quiz->isCode)
                                    <th>Type</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key => $question)
                            <tr>
                                <td>{{ $key+1 }}.</td>
                                <td>{{ substr($question->question, 0, 100) }}{{ strlen($question->question) > 100 ? "..." : "" }}</td>
                                <td> <img src="{{ $question->question_image ? asset('storage/images/'.$question->question_image) : ''}}" class="z-depth-1" style="object-fit:cover;height:100px;width:100px;" alt=""> </td>
                                @if (!$quiz->isCode)
                                    <td>
                                        @if ($question->option_one == null && $question->option_two == null && $question->option_three == null)
                                            Identification
                                            @else 
                                            Multiple Choice
                                        @endif
                                    </td>
                                @endif
                                <td>
                                    <a href="{{ route('instructor.question.edit', [$course->id, $quiz->id, $question->id]) }}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a> 
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.question.destroy', [$course->id, $quiz->id, $question->id]) }}" class="perma_delete text-danger" data-placement="left" data-method="delete" data-from="quiz" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> 
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
            "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search",
            },
            order:[]
        });
    });

</script>
@endsection
