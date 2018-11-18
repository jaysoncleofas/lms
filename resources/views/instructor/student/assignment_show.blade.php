@extends('layouts.app')

@section('styles')
    <style>
        .nav-tabs{
            background-color: white !important;
            color: black !important;
        }
        .nav-tabs .nav-link.active {
            color: black !important
        }
        .nav-tabs .nav-link {
            color: black !important
        }
    </style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div>
                <div class="post-prev-title">
                    <h3>{{ $course->name }}</h3>
                </div>
                <div class="post-prev-info mb-0">
                    {{ $section->name }}
                </div>
            </div>
            <div>
                <a href="{{ route('instructor.assignment.show', [$course->id, $assignment->id]) }}" class="btn btn-light my-0 mr-0"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
    <hr class="mt-3">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-10 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h4 class="text-oswald">{{ $assignment->title }}</h4>
                            {!! $assignment->content !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <p class="mb-0"><strong>Student:</strong> {{ $submit->user->name() }}</p>
                            <p><strong>Grade:</strong> {{ $submit->grade == 0 ? '' : $submit->grade }}
                                <a href="" data-toggle="modal" data-target="#basicExampleModal" class="btn btn-light btn-sm"> {{ $submit->grade == 0 ? 'Add' : 'Edit' }}</a>   
                            </p>
                            <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $submit->grade == '' ? 'Add' : 'Edit' }} Grade</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('instructor.assignment.passUpdate', $submit->id) }}" method="post">
                                            @csrf @method('PUT')
                                            <div class="modal-body">
                                                <div class="md-form">
                                                    <input type="number" name="grade" id="grade" class="form-control" value="{{ $submit->grade }}">
                                                    <label for="grade">Grade</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary mt-0 float-right">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if ($assignment->isCode)
                                <div class="form-group mb-3">
                                    <p class="select2Label">Code</p>
                                    <textarea type="text" id="code" name="code" rows="15" class="form-control rounded-0 {{$errors->has('code') ? 'is-invalid' : ''}}" rows="3" readonly>{{ $submit->content }}</textarea>
                                </div>
                                <a id="execute" class="btn btn-info"><i class="fa fa-save"></i> Run</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if ($assignment->isCode)
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                    <p class="select2Label">Result...</p>
                                <p id="result"></p>
                            </div>
                        </div>
                    </div>
                </div>
            @else 
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10 mb-5">
                                <h4 class="text-oswald text-center py-3">Assignment</h4>
                                {!! $submit->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
         
@section('script')
    @include('partials.notification')
    <script>
        $(document).ready(function() {
            $("#execute").click(function () {
            var code = $("#code").val();

            var url = '{{ route('runCode') }}';
            $.ajax({
                type: 'post',
                url: url,
                data: {code: code},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    // $('.redeem_send_btn').attr('disabled', 'disabled');
                },
                success: function(result) {
                    console.log(result);
                    result = JSON.parse(result);
                    $("#result").text(result.text);
                }
            })

        });
    });
    </script>
@endsection