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
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <hr class="mt-3">
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-10 col-md-12 mb-3">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="text-oswald mb-0">Add Assignment</h5>
                </div>
                <div class="card-body">
                    <form class="" action="{{route('instructor.assignment.store', $course->id)}}" method="post">
                        @csrf
                        <div class="md-form">
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                            <label for="title">Title <span class="red-asterisk">*</span></label>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="md-form pb-3 pt-2 mt-0">
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" name="codeAssignment" id="codeAssignment" value="1" {{ old('codeAssignment') == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="codeAssignment">Code Assignment</label>
                            </div>
                        </div>
                        
                        <div class="md-form mb-3">
                            <p class="select2Label">Content <span class="red-asterisk">*</span></p>
                            <textarea name="content" id="content" class="md-textarea form-control pt-0 {{ $errors->has('content') ? 'is-invalid' : '' }}" rows="15">{{ old('content') }}</textarea>
                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="md-form mb-3">
                                    <input type="text" name="startDate" id="startDate" class="datepicker form-control" value="{{ old('startDate') }}">
                                    <label for="startDate">Start Date <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('startDate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('startDate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-3">
                                    <input type="text" name="expireDate" id="expireDate" class="datepicker form-control" value="{{ old('expireDate') }}">
                                    <label for="expireDate">Expire Date <span class="red-asterisk">*</span></label>
                                    @if ($errors->has('expireDate'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expireDate') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <p class="mb-0 select2Label">Assign Section <span class="red-asterisk">*</span></p>
                        <div class="md-form mt-0">
                            <select class="multiple-select form-control" multiple="multiple" id="sections" name="sections[]" style="width:100% !important;">
                                @foreach ($sections as $section2)
                                    <option value="{{ $section2->id }}">{{ $section2->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('expireDate'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expireDate') }}</strong>
                                </span>
                            @endif
                            <div class="form-check pl-0">
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="checkbox">All Section</label>
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

@section('script')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script>
        $('.multiple-select').select2();
        $('.multiple-select').select2().val({!!json_encode(old('sections')) !!}).trigger('change');
        $("#checkbox").on('click',function(){
            if($("#checkbox").is(':checked') ){
                $('.multiple-select').select2('destroy').find('option').prop('selected', 'selected').end().select2();
            }else{
                $('.multiple-select').select2('destroy').find('option').prop('selected', false).end().select2();
            }
        });
        $('.datepicker').pickadate({
            min: new Date(),
            formatSubmit: 'yyyy-mm-dd',
            hiddenPrefix: 'formatted_',
        });
    </script>
@endsection
