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
            <a href="{{ route('instructor.assignment.create', $course->id) }}" class="btn btn-primary my-0 mr-0"><i class="fa fa-plus"></i> Add Assignment</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-address-book fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{ count($assignments) }}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Assignment{{ count($assignments) > 1 ? 's' : '' }}</h2>
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
                                <th>Start Date</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $key => $assignment)
                            <tr>
                                <td>{{$key+1}}.</td>
                                <td>
                                    <a href="{{ route('instructor.assignment.show', [$course->id, $assignment->id]) }}" class="btn-link" title="{{ $assignment->title }}"><strong>{{ $assignment->isCode ? 'Code:' : '' }}</strong> {{ substr($assignment->title, 0, 30) }}{{ strlen($assignment->title) > 30 ? "..." : "" }}</a></td>
                                <td>
                                    @foreach ($assignment->sections as $key => $section2)
                                        {{ $section2->name }}{{ $key < count($assignment->sections) - 1 ? ', ' : ''  }}
                                    @endforeach
                                </td>
                                <td>{{ $assignment->startDate ? $assignment->startDate->toFormattedDateString() : '' }}</td>
                                <td>{{ $assignment->expireDate ? $assignment->expireDate->toFormattedDateString() : '' }}</td>
                                <td>
                                    <div class="switch">
                                        <label>
                                            Inactive
                                            <input class="active-mode-switch" type="checkbox" {{ $assignment->isActive ? 'checked' : '' }} assignmentId="{{ $assignment->id }}">
                                            <span class="lever"></span> Active
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('instructor.assignment.edit', [$course->id, $assignment->id])}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a> 
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.assignment.destroy', [$course->id, $assignment->id]) }}" class="perma_delete text-danger" data-placement="left" data-method="delete" data-from="assignment" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> 
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
            $('.active-mode-switch').change(function() {
                var status = 0;
                var id = $(this).attr('assignmentId');
                if ($(this).is(':checked')) {
                    status = 1;
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : "{{ route('instructor.assignment.status', [$course->id, $assignment->id]) }}",
                    type : 'PUT',
                    data: { id: id, status : status },
                    success: function(result) {
                        var newResult = JSON.parse(result);
                        const toast = swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });

                        toast({
                            type: 'success',
                            title: newResult.status
                        })
                    },
                    error : function(error) {
                        console.log('error');
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
