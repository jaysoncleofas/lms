@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
        <a href="{{route('instructor.token.create', $course->id)}}" class="btn btn-primary mr-0"><i class="fa fa-plus"></i> Add Token</a>
    </div>
    <div class="row mt-lg-3">
        <div class="col-lg-4 col-sm-4 mb-4">
            <div class="card">
                <div class="text-white blue text-center py-4 px-4">
                    <i class="fa fa-key fa-3x tiles-left-icon"></i> 
                    <h2 class="card-title pt-2 text-white text-oswald"><strong>{{count($tokens)}}</strong></h2>
                    <h2 class="text-uppercase text-white text-oswald">Token{{count($tokens) > 1 ? 's' : ''}}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-lg-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body pb-0">
                    <table id="example" class="table text-nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Token</th>
                                <th>Section</th>
                                <th>Date Created</th>
                                <th>Expiration Date</th>
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
                                <td>{{$token->expireDate != null ? date('F j, Y',strtotime($token->expireDate)) : ''}}</td>
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.token.update', [$course->id, $token->id]) }}" class="deactivate btn btn-sm {{ $token->status == 1 ? 'btn-success' : 'btn-danger'  }}" data-method="put" data-from="token" data-action="{{ $token->status == 1 ? 'deactivate' : 'activate' }}" data-from="token" data-value="{{ $token->status == 1 ? 0 : 1  }}">
                                        @if ($token->status == 1) 
                                            Active
                                        @else 
                                            Inactive
                                        @endif    
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" data-href="{{ route('instructor.token.destroy', [$course->id, $token->id]) }}" class="perma_delete text-danger" data-method="delete" data-from="token" data-toggle="tooltip" title="Delete" data-placement="left"><i class="fa fa-trash"></i></a> 
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
