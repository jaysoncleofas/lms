@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-graduation-cap fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Section{{count($sections) > 1 ? 's' : ''}}</h2>
                    <a href="{{route('instructor.section.index', $course->id)}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 mb-3">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                    <i class="fa fa-minus-circle fa-3x tiles-left-icon"></i>
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections2)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Deactivated Section{{count($sections) > 1 ? 's' : ''}}</h2>
                    <a href="{{route('instructor.section.deactivated', $course->id)}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr class="mb-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>Deactivated Section</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">Section</th>
                                <th>Students</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections2 as $key => $section)
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td>
                                    {{ count($section->users) }}                        
                                </td>
                                <td>                                
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.section.status', [$course->id, $section->id]) }}" class="deactivate green-text mr-3" data-toggle="tooltip" title="Restore" data-placement="left" data-action="restore" data-method="put" data-from="section" data-value="1"><i class="fa fa-undo"></i></a> 
                                    <a href="{{ route('instructor.section.edit', [$course->id, $section->id]) }}" class="blue-text mr-3" data-toggle="tooltip" title="Edit" data-placement="left"><i class="fa fa-pencil"></i></a> 
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.section.destroy', [$section->id, $section->id]) }}" class="perma_delete text-danger" data-placement="left" data-method="delete" data-from="section" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a> 
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

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@endsection
