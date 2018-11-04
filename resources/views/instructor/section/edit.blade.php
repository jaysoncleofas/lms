@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row px-3 d-flex justify-content-between align-items-center">
        <h3 class="text-oswald font-weight-bold">Course: <span class="font-weight-normal">{{ $course->name }}</span> </h3>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-xl-6 col-md-6 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Update Section</h3>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <form action="{{route('instructor.section.update', [$course->id, $section->id])}}" method="post">
                        {{ csrf_field() }} {{method_field('PUT')}}
                        <div class="form-row">
                            <div class="col-12">
                                <div class="md-form">
                                    <input type="text" name="name" id="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                        value="{{$section->name}}">
                                    <label for="name">Section Name <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-pencil-alt"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
