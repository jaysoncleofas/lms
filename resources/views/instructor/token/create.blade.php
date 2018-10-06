@extends('layouts.app')

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
                                        <select class="mdb-select {{$errors->has('section') ? 'is-invalid' : ''}}" name="section" id="section">
                                            <option selected disabled>Select</option>
                                            @foreach ($sections as $section)
                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="section">Section</label>
                                        @if ($errors->has('section'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="md-form mb-3">
                                        <input type="text" name="expireDate" id="expireDate" class="datepicker form-control" value="{{old('expireDate')}}">
                                        <label for="expireDate">Expire Date</label>
                                        @if ($errors->has('expireDate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expireDate') }}</strong>
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
    @include('partials.notification')
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
