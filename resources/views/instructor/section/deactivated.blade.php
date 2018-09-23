@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection 

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
        <a href="{{route('instructor.section.index', $course->id)}}" class="btn btn-danger">Back</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
                        <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($sections)}}</strong></h2>
                        <h2 class="text-uppercase text-white text-oswald">Section{{count($sections) > 1 ? 's' : ''}}</h2>
                    <a href="{{route('instructor.section.index', $course->id)}}" class="px-4">
                        <div class="mask rgba-white-slight">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card blue">
                <div class="view overlay text-white text-center py-4">
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
    <div class="row mt-lg-3">
        <div class="col-lg-12">
            <h4 class="text-oswald">Deactivated Section</h4>
        </div>
        <div class="col-lg-12">
            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th></th>
                        <th scope="col">Section</th>
                        <th>Students</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections2 as $key => $section)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <th>
                            <a href="#" class="green-text" onclick="if(confirm('Are you sure you want to restore this section?')) {
                                event.preventDefault();
                                $('#deactivate-form-{{$section->id}}').submit();
                                }">
                            Restore
                            </a>

                            <form id="deactivate-form-{{$section->id}}" action="{{ route('instructor.section.status', [$course->id, $section->id]) }}"
                            method="post">
                            @csrf {{method_field('PUT')}}
                            <input type="hidden" name="status" value="1">
                            </form>
                        </th>
                        <td>{{$section->name}}</td>
                        <td>
                            {{count($section->users)}}                        
                        </td>
                        <td>
                            <a href="{{route('instructor.section.edit', [$course->id, $section->id])}}" class="px-2 blue-text waves-effect">Edit</a>
                            <a href="#" class="px-2 red-text waves-effect" onclick="if(confirm('Are you sure you want to permamently delete this section?')) {
                                                event.preventDefault();
                                                $('#delete-section-form-{{$section->id}}').submit();
                                                }">
                                Delete
                            </a>

                            <form id="delete-section-form-{{$section->id}}" action="{{ route('instructor.section.destroy', [$course->id, $section->id]) }}"
                                method="post">
                                @csrf {{method_field('DELETE')}}
        
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
