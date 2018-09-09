@extends('layouts.app')

@section('styles')
<link href="{{ asset('SmartWizard/dist/css/smart_wizard.css') }}" rel="stylesheet">
<link href="{{ asset('SmartWizard/dist/css/smart_wizard_theme_arrows.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{route('student.dashboard')}}">Course</a>
                    <span class="breadcrumb-item active">{{$course->name}}</span>
                    <span class="breadcrumb-item active">Section</span>
                    <span class="breadcrumb-item active">{{$section->name}}</span>
                    <span class="breadcrumb-item active">Lesson</span>
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            
            <div class="col-xl-12 col-md-12 mb-4">
                <!-- SmartWizard html -->
                <div>Registration closes in <span id="time">05:00</span> minutes!
                <div id="smartwizard">
                    <ul id="wizard">
                        @foreach ($quiz->questions as $question)
                            <li><a href="#step-{{$question->id}}">{{$question->question}}<br /></a></li>
                        @endforeach
                    </ul>

                    <div>
                        @foreach ($quiz->questions as $question)
                            <div id="step-{{$question->id}}" class="">
                                <h3 class="border-bottom border-gray pb-2">{{$question->question}} ?</h3>
                                <img src="{{asset('storage/images/'.$question->question_image)}}" alt="">

                                @php
                                    $choices = [
                                        $question->correct,
                                        $question->option_one,
                                        $question->option_two,
                                        $question->option_three
                                    ];

                                    shuffle($choices);
                                @endphp

                                @foreach ($choices as $key => $item)
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="materialGroup{{$key.''.$question->id}}" name="groupOfMaterialRadios{{$question->id}}">
                                            <label class="form-check-label" for="materialGroup{{$key.''.$question->id}}"> {{$item}}</label>
                                      </div>
                                @endforeach
                            </div>
                        @endforeach    
                    </div>
                </div>
            </div>    

                    
                {{-- @foreach ($quiz->questions as $question)
                
                    <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <h2 class="text-center text-oswald py-4">{{$question->question}}</h2>

                        
                                        {{($question->choices)}}
                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            
        </div>
    </div>
@endsection


@section('script')
<script src="{{ asset('SmartWizard/dist/js/jquery.smartWizard.min.js') }}"></script>
<script>
    $(document).ready(function(){
      $('#smartwizard').smartWizard();

    });
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 5,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
    </script>
@endsection