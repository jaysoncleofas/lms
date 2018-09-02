@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('instructor.dashboard')}}">{{$course->name}}</a>
                    <a class="breadcrumb-item" href="{{route('instructor.section.index', $course->id)}}">{{$section->name}}</a>
                    <span class="breadcrumb-item active">Token</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3">
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card card-cascade narrower z-depth-1">
                    <div class="view gradient-card-header indigo narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
                            <a class="white-text mx-3">Tokens</a>
                        <div>
                            <a class="btn btn-outline-white btn-rounded btn-sm px-2" data-toggle="tooltip" data-placement="top" title="Generate Token" onclick="
                                        event.preventDefault();
                                        $('#generateToken{{$course->id}}').submit();
                                      "><i class="fa fa-pencil mt-0"></i></a>
                            <form id="generateToken{{$course->id}}" action="{{route('instructor.token.store', [$course->id, $section->id])}}" method="post">
                                {{ csrf_field() }}

                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <td>Token</td>
                                        <td>Date Created</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tokens as $token)
                                        <tr>
                                            <td>{{$token->token}}</td>
                                            <td>{{date('F j, Y',strtotime($token->created_at))}}</td>
                                            <td>
                                                @if ($token->status == 1)
                                                    <a href="#" class="btn btn-sm btn-success" onclick="if(confirm('Are you sure you want to deactivate this token?')) {
                                                                event.preventDefault();
                                                                $('#deactivate-form-{{$token->id}}').submit();
                                                              }">
                                                              Active
                                                    </a>
                                                    <form id="deactivate-form-{{$token->id}}" action="{{ route('instructor.token.update', [$course->id, $section->id, $token->id]) }}" method="post">
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
                                                    <form id="activate-form-{{$token->id}}" action="{{ route('instructor.token.update', [$course->id, $section->id, $token->id]) }}" method="post">
                                                      @csrf {{method_field('PUT')}}
                                                      <input type="hidden" name="status" value="1">
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this token?')) {
                                                            event.preventDefault();
                                                            $('#delete-token-form-{{$token->id}}').submit();
                                                          }">
                                                    Delete
                                                </a>
                                                <form id="delete-token-form-{{$token->id}}" action="{{ route('instructor.token.destroy', [$course->id, $section->id, $token->id]) }}" method="post">
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('Datatables/datatables.min.js') }}"></script>
    @include('partials.notification')
    <script>
    $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
