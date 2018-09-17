@extends('layouts.app')

@section('styles')
    <link href="{{ asset('Datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                    <h3 class="text-oswald">{{$course->name}}</h3>
                </div>

        <div class="row justify-content-center mt-5">
            <div class="col-xl-6 col-md-6 mb-4">
                    <div class="row px-3 d-flex justify-content-between align-items-center">
                            <h3 class="text-oswald">Generate Token</h3>
                            <a href="{{route('instructor.token.index', $course->id)}}" class="btn btn-danger">Back</a>
                        </div>
                        <form class="" action="{{route('instructor.token.store', $course->id)}}" method="post">
                            {{ csrf_field() }}
      
                                    <div class="md-form">
                                        <select class="mdb-select {{$errors->has('section') ? 'is-invalid' : ''}}" name="section">
                                            <option selected disabled>Select</option>
                                            @foreach ($sections as $section)
                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                        <label>Section</label>
                                        @if ($errors->has('section'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                        @endif
                                    </div>
       
                            <button type="submit" name="button" class="btn btn-primary pull-right">Generate</button>
                        </form>
            
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('Datatables/datatables.min.js') }}"></script>
    @include('partials.notification')
    <script>
    $(document).ready(function () {
            $('.mdb-select').material_select();
            $('#example').DataTable();
        });
    </script>
@endsection
