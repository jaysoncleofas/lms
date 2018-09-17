@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">

    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
        <a href="{{route('instructor.token.create', $course->id)}}" class="btn btn-primary">Add Token</a>
    </div>

    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($tokens)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Tokens</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">

            <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Token</th>
                        <th>Section</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tokens as $token)
                    <tr>
                        <td>{{$token->token}}</td>
                        <td>{{$token->section->name ?? ''}}</td>
                        <td>{{date('F j, Y',strtotime($token->created_at))}}</td>
                        <td>
                            @if ($token->status == 1)
                            <a href="#" class="btn btn-sm btn-success" onclick="if(confirm('Are you sure you want to deactivate this token?')) {
                                                                event.preventDefault();
                                                                $('#deactivate-form-{{$token->id}}').submit();
                                                              }">
                                Active
                            </a>
                            <form id="deactivate-form-{{$token->id}}" action="{{ route('instructor.token.update', [$course->id, $token->id]) }}"
                                method="post">
                                @csrf {{method_field('PUT')}}
                                <input type="hidden" name="status" value="0">
                            </form>
                            @else
                            <a href="#" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to activate this token?')) {
                                                                event.preventDefault();
                                                                $('#activate-form-{{$token->id}}').submit();
                                                              }">
                                Deactivate
                            </a>
                            <form id="activate-form-{{$token->id}}" action="{{ route('instructor.token.update', [$course->id, $token->id]) }}"
                                method="post">
                                @csrf {{method_field('PUT')}}
                                <input type="hidden" name="status" value="1">
                            </form>
                            @endif
                        </td>
                        <td>
                            <a class="text-danger" onclick="if(confirm('Are you sure you want to delete this token?')) {
                                                            event.preventDefault();
                                                            $('#delete-token-form-{{$token->id}}').submit();
                                                          }">
                                Delete
                            </a>
                            <form id="delete-token-form-{{$token->id}}" action="{{ route('instructor.token.destroy', [$course->id, $token->id]) }}"
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
