@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span></h3>
            <h3 class="text-oswald font-weight-bold">Section: <span class="font-weight-normal">{{ $take->section->name }}</span></h3>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-10 col-md-12 mb-4">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <strong>{{ $quiz->title }}</strong>
                            <p>{{ $quiz->content }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            {{-- <div class="row justify-content-between d-flex mx-1"> --}}
                                <p class="mb-0"><strong>Student:</strong> {{ $take->user->name() }}</p>
                                <p><strong>Grade:</strong> {{ $take->result }}
                                    <a href="" data-toggle="modal" data-target="#basicExampleModal"> {{ $take->result == '' ? 'Add' : 'Edit' }}</a>   
                                </p>
                                <!-- Modal -->
                                <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $take->result == '' ? 'Add' : 'Edit' }} Grade</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <div class="md-form">
                                                <input type="number" name="grade" id="grade" class="form-control" value="{{ $take->result }}">
                                                        <label for="grade">Grade</label>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            <div class="form-group mb-3">
                                <p class="select2Label">Code</p>
                                <textarea type="text" id="code" name="code" rows="15" class="form-control rounded-0 {{$errors->has('code') ? 'is-invalid' : ''}}" rows="3" readonly>{{ $take->code }}</textarea>
                            </div>
                            <a id="execute" class="btn btn-info mt-4 float-right"><i class="fa fa-save"></i> Execute</a>
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