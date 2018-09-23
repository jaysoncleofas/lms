@extends('layouts.app')

@section('styles')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=fwl1zems9tvf6ysxti5p5zrr86dawn4f0zdyzwoel3rjh9ok"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<script>
    tinymce.init({ 
        selector:'textarea' 
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

    <div class="row mt-lg-3 justify-content-center">

        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <h2 class="text-center py-5 text-oswald">{{$assignment->title}}</h2>

                            <p>{!! $assignment->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <form id="pass-assignment-form-{{$assignment->id}}" action="{{route('student.pass.store_assignment', [$course->id, $section->id, $assignment->id])}}" method="POST">
            @csrf

                <div class="md-form mb-3">
                    <p>Content</p>
                    <textarea name="content" id="content" class="md-textarea form-control pt-0 {{$errors->has('content') ? 'is-invalid' : ''}}"
                        rows="15">{{old('content')}}</textarea>
                    {{-- <label for="content">Description</label> --}}
                    @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('content') }}</strong>
                    </span>
                    @endif
                </div>

                <button type="submit" id="passAssignment" class="btn btn-primary pull-right">Submit</button>
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

         $('#passAssignment').on('click', function(){

                if(confirm('When you pass your assignment, you can\'t edit it\'s content!')) {

                    $('#pass-assignment-form-{{$assignment->id}}').submit();
                    }

                    else {

                        return false;
                    }

            })

    });

  </script>
@endsection
