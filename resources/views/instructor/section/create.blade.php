@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald">{{$course->name}}</h3>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-xl-6 col-md-6 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Add Section</h3>
                <a href="{{route('instructor.section.index', $course->id)}}" class="btn btn-danger">Back</a>
            </div>

            <form action="{{route('instructor.section.store', $course->id)}}" method="post">
                {{ csrf_field() }}
                <div class="form-row">
                    <div class="col-12">
                        <div class="md-form">
                            <input type="text" name="name" is="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                value="{{old('name')}}">
                            <label for="name">Section Name</label>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-primary pull-right mt-4">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
