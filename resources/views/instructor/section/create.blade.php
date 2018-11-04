@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span> </h3>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-xl-6 col-md-6 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Add Section</h3>
                {{-- <a href="{{route('instructor.section.index', $course->id)}}" class="btn btn-danger">Back</a> --}}
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{route('instructor.section.store', $course->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-12">
                                <div class="md-form">
                                    <input type="text" name="name" id="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{old('name')}}">
                                    <label for="name">Section Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
