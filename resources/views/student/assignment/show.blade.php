@extends('layouts.app')

@section('styles')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fwl1zems9tvf6ysxti5p5zrr86dawn4f0zdyzwoel3rjh9ok"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<script>
    tinymce.init({ 
        selector:'.isContent' 
    });
    </script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
            <h4 class="text-oswald">Assignmment </h4>
        </div>
    </div>

    <div class="row mt-3 justify-content-center">

        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <strong>{{ $assignment->title }}</strong>
                            {!! $assignment->content !!}
                        </div>
                    </div>
                </div>
            </div>

            <form id="pass-assignment-form-{{$assignment->id}}" action="{{route('student.pass.store_assignment', [$course->id, $section->id, $assignment->id])}}" method="POST">
            @csrf
                @if (!$assignment->isCode)
                    <div class="form-group mb-3">
                        <p class="mb-1">Content <span class="red-asterisk">*</span></p>
                        <textarea name="content" id="content" class="form-control rounded-0 pt-0 {{$errors->has('content') ? 'is-invalid' : ''}} isContent" rows="15">{{old('content')}}</textarea>
                        {{-- <label for="content">Description</label> --}}
                        @if ($errors->has('content'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <p class="mb-1">Code <span class="red-asterisk">*</span></p>
                                <textarea name="code" id="code" class="form-control rounded-0 pt-0 {{$errors->has('code') ? 'is-invalid' : ''}}" rows="15">{{old('code')}}</textarea>
                                {{-- <label for="code">Description</label> --}}
                                @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <a id="execute" class="btn btn-info"><i class="fa fa-save"></i> Run</a>
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
                @endif

                <button type="submit" id="passAssignment" class="btn btn-primary float-right mt-4"><i class="fa fa-check"></i> Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        window.onbeforeunload = function() {
            return true;
        };

        $('#pass-assignment-form-{{$assignment->id}}').on('submit', function(){
            window.onbeforeunload = null;
        });

            $(document).on('click', '#passAssignment', function(e) {
            e.preventDefault();
            var $this = $(this);
            swal({
                title: 'Are you sure you want to submit this assignment?',
                // text: 'Are you sure you want to submit this assignment?!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.onbeforeunload = null;
                    $('#pass-assignment-form-{{$assignment->id}}').submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    toast({
                        type: 'error',
                        title: 'Cancelled.'
                    })
                }
            })   
        });

            $("#execute").click(function () {
                var code = $("#code").val();

                // $("#form_id").submit(); // Form submission.
                // alert(code);

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
