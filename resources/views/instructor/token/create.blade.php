@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="post-prev-title">
                    <h3>{{ $course->name }}</h3>
                </div>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-xl-6 col-md-6 mb-3">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5 class="text-oswald mb-0">Generate Token</h5>
                    </div>
                    <div class="card-body">
                        <form class="" action="{{route('instructor.token.store', $course->id)}}" method="post">
                            {{ csrf_field() }}

                            <div class="md-form">
                                <select class="mdb-select {{$errors->has('section') ? 'is-invalid' : ''}}" name="section" id="section">
                                    <option selected disabled>Select</option>
                                    @foreach ($sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                </select>
                                <label for="section">Section <span class="red-asterisk">*</span></label>
                                @if ($errors->has('section'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('section') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="md-form mb-3">
                                <input type="text" name="expireDate" id="expireDate" class="datepicker form-control" value="{{old('expireDate')}}">
                                <label for="expireDate">Expire Date <span class="red-asterisk">*</span></label>
                                @if ($errors->has('expireDate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expireDate') }}</strong>
                                </span>
                                @endif
                            </div>

                            <button type="submit" name="button" class="btn btn-primary float-right mt-4"><i class="fa fa-plus-circle"></i> Generate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    $(document).ready(function () {
            $('.mdb-select').material_select();
            $('.datepicker').pickadate({
                min: new Date(),
                formatSubmit: 'yyyy-mm-dd',
                hiddenPrefix: 'formatted_',
            });
        });
    </script>
@endsection
