@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
        <a href="{{ route('instructor.assignment.create', $course->id) }}" class="btn btn-primary mr-0"><i class="fa fa-plus"></i> Add Assignment</a>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
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
                                <th>Title</th>
                                <th>Sections</th>
                                <th>Start Date</th>
                                <th>Expire Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $assignment)
                            <tr>
                                <td><a href="{{ route('instructor.assignment.show', [$course->id, $assignment->id]) }}" class="blue-text">{{ $assignment->title }}</a></td>
                                <td>
                                    @foreach ($assignment->sections as $key => $section2)
                                        {{ $section2->name }}{{ $key < count($assignment->sections) - 1 ? ', ' : ''  }}
                                    @endforeach
                                </td>
                                <td>{{ $assignment->startDate ? $assignment->startDate->toFormattedDateString() : '' }}</td>
                                <td>{{ $assignment->expireDate ? $assignment->expireDate->toFormattedDateString() : '' }}</td>
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.assignment.status', [$course->id, $assignment->id]) }}" class="deactivate btn btn-sm {{ $assignment->isActive == 1 ? 'btn-success' : 'btn-danger'  }}" data-method="put" data-from="assignment" data-action="{{ $assignment->isActive == 1 ? 'deactivate' : 'activate' }}" data-from="token" data-value="{{ $assignment->isActive == 1 ? 0 : 1  }}">
                                        @if ($assignment->isActive == 1) 
                                            Active
                                        @else 
                                            Inactive
                                        @endif    
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('instructor.assignment.edit', [$course->id, $assignment->id])}}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil-alt"></i></a> 
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
    @include('partials.notification')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "scrollX": true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                }
            });
        });
    </script>
@endsection
