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
                                                    <input type="text" name="grade" id="grade" class="form-control" value="{{ $submit->grade }}">
                                                    <label for="grade">Grade</label>
                                                    {{-- <span class="invalid-feedback" role="alert">
                                                        <strong id="grade_alert">Max limit to 100</strong>
                                                    </span> --}}
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
                                <div class="form-group mb-3">
                                    <p class="mb-1">Stdin Inputs</p>
                                    <textarea name="stdin" id="stdin" class="form-control rounded-0 pt-0" rows="3">{{old('stdin')}}</textarea>
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
                                <p id="result" style="white-space: pre-line"></p>
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
                var _this = $(this);
                _this.html('<i class="fa fa-spinner fa-spin loading"></i> Running');
                var code = $("#code").val();
                var stdin = $("#stdin").val();
                var url = '{{ route('runCode') }}';
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {code: code, stdin, stdin},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        _this.attr('disabled', 'disable');
                    },
                    success: function(result) {
                        setTimeout(function () {
                            _this.html('<i class="fa fa-save"></i> Run');
                            result = JSON.parse(result);
                            $("#result").html(result.text);
                            $('#execute').attr('disabled');
                        }, 800);
                    },
                    error: function(result){
                        console.log(result);
                    },
                    complete: function() {
                        _this.removeAttr('disabled');
                    }
                })
            });
            // $('#grade').keyup(function(){
            //     if ($(this).val() > 100){
            //         $(this).val('100');
            //         $('#grade_alert').text('Max limit to 100');
            //     } else {
            //         $('#grade_alert').text('');
            //     }
            // });

            // Restricts input for the given textbox to the given inputFilter.
            function setInputFilter(textbox, inputFilter) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                    textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                    });
                });
            }

            setInputFilter(document.getElementById("grade"), function(value) {
                return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 101); });

        });
    </script>
@endsection