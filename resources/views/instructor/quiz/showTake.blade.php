@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <div class="post-prev-info mb-0">
                {{ $take->section->name }}
            </div>
            <hr class="mt-0">
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-10 col-md-12 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <h4 class="text-oswald">{{ $quiz->title }}</h4>
                            <p>{{ $quiz->content }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                                <p class="mb-0"><strong>Student:</strong> {{ $take->user->name() }}</p>
                                <p><strong>Grade:</strong> {{ $take->result }}
                                    <a data-toggle="modal" data-target="#basicExampleModal" class="btn btn-light btn-sm"> {{ $take->result == '' ? 'Add' : 'Edit' }}</a>   
                                </p>
                                <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $take->result == '' ? 'Add' : 'Edit' }} Grade</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <form action="{{ route('instructor.quiz.takeUpdate', $take->id) }}" method="post">
                                            @csrf @method('PUT')
                                            <div class="modal-body">
                                                <div class="md-form">
                                                    <input type="text" name="grade" id="grade" class="form-control" value="{{ $take->result }}">
                                                        <label for="grade">Grade</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            <div class="form-group mb-3">
                                <p class="select2Label">Code</p>
                                <textarea type="text" id="code" name="code" rows="15" class="form-control rounded-0 {{$errors->has('code') ? 'is-invalid' : ''}}" rows="3" readonly>{{ $take->code }}</textarea>
                            </div>
                            <a id="execute" class="btn btn-info"><i class="fa fa-save"></i> Run</a>
                        </div>
                    </div>
                </div>
            </div>

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
        </div>
    </div>
</div>
@endsection
 
@section('script')
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