@extends('layouts.app')

@section('styles')
<link href="{{ asset('SmartWizard/dist/css/smart_wizard_theme_dots.css') }}" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/tl-ph.js" rel="stylesheet"> --}}

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-oswald">{{$course->name}} / {{$section->name}}</h3>
            <h4 class="text-oswald">Quiz / {{$quiz->title}}</h4>
        </div>
    </div>

    <div class="row mt-lg-3 justify-content-center">

        <div class="col-lg-12 col-md-12 mb-4">
            @if ($quiz->timeLimit > 0)
            <h4 class="text-oswald text-center"><span id="divCounter"></span> minutes</h4>
            @endif

                    <form id="take-quiz-form-{{$quiz->id}}" action="{{route('student.take.store', [$course->id, $section->id, $quiz->id])}}" method="POST">
                            @csrf
        <div id="smartwizard">
                <ul>
                    <?php $i = 1; ?>
                    @foreach($quiz->questions as $question)
                    <li><a href="#step-{{$i}}">Q {{$i}}</a></li>
                    <?php $i++; ?>
                    @endforeach
                </ul>


                <div>
                    <?php $i = 1; ?>
                    @foreach($quiz->questions as $question)
                    <div id="step-{{$i}}" class="">
                        <h4 class="text-oswald">{{ $i }}. {{$question->question}} ?</h4>
                        <input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">

                                <img src="{{asset('storage/images/'.$question->question_image)}}" alt="" class="img-fluid mb-3 z-depth-1">

                                @php
                                if($question->option_one == '' && $question->option_two == '' && $question->option_three == ''){
                                    $choices = [$question->correct];
                                } else {
                                    $choices = [
                                    $question->correct,
                                    $question->option_one,
                                    $question->option_two,
                                    $question->option_three
                                    ];
                                }

                                shuffle($choices);
                                @endphp

                                @if (count($choices) == 1)
                                    <div class="md-form">
                                            <input type="text" name="answers[{{ $question->id }}]" value="" class="form-control"
                                            id="choices{{ $question->id }}">
                                            <label for="choices{{ $question->id }}">Answer</label>
                                    </div>
                                @else
                                    @foreach($choices as $key => $option)
                                    @if (!empty($option))
                                        <div class="form-check">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" class="form-check-input"
                                            id="choices{{ $key.''.$question->id }}">
                                        <label class="form-check-label" for="choices{{ $key.''.$question->id }}">{{ $option
                                            }}</label>
                                    </div>
                                    @endif

                                    @endforeach
                                @endif
                    </div>
                    <?php $i++; ?>
                    @endforeach

                </div>

            </div>
        </form>


        </div>


</div>
@endsection

@section('script')
<script src="{{asset('SmartWizard/dist/js/jquery.smartWizard.js')}}"></script>
<script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        // Smart Wizard
        $('#smartwizard').smartWizard({
              selected: 0,  // Initial selected step, 0 = first step
              keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
              autoAdjustHeight:true, // Automatically adjust content height
              cycleSteps: false, // Allows to cycle the navigation of steps
              backButtonSupport: true, // Enable the back button support
              useURLhash: true, // Enable selection of the step based on url hash
              lang: {  // Language variables
                  next: 'Next',
                  previous: 'Previous'
              },
              toolbarSettings: {
                  toolbarPosition: 'bottom', // none, top, bottom, both
                  toolbarButtonPosition: 'right', // left, right
                  showNextButton: true, // show/hide a Next button
                  showPreviousButton: true, // show/hide a Previous button
                  toolbarExtraButtons: [
              $('<button></button>').text('Finish')
                            .addClass('btn btn-info')
                            .on('click', function(){

                                if(confirm('Are you sure you want to finish this quiz?')) {

                                                                $('#take-quiz-form-{{$quiz->id}}').submit();
                                                              }

                                                              else {

                                                                  return false;
                                                              }

                            })
                        ]
              },
              anchorSettings: {
                  anchorClickable: true, // Enable/Disable anchor navigation
                  enableAllAnchors: false, // Activates all anchors clickable all times
                  markDoneStep: true, // add done css
                  enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
              },
              contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
              disabledSteps: [],    // Array Steps disabled
              errorSteps: [],    // Highlight step with errors
              theme: 'dots',
              transitionEffect: 'fade', // Effect on navigation, none/slide/fade
              transitionSpeed: '400'
        });

        $('.step-anchor').removeClass('nav-tabs');
        $('.sw-btn-group-extra').addClass('mt-3');
        $('.sw-btn-group').addClass('mt-3');




    });


  </script>

    <script>
        //var hoursleft = 0;
        var minutesleft = {{$quiz->timeLimit}}; //give minutes you wish
        var secondsleft = 00; // give seconds you wish
        var finishedtext = "Countdown finished!";
        var end1_{{$csqu}};
        if(localStorage.getItem("end1_{{$csqu}}")) {
        end1_{{$csqu}} = new Date(localStorage.getItem("end1_{{$csqu}}"));
        } else {
        end1_{{$csqu}} = new Date();
        end1_{{$csqu}}.setMinutes(end1_{{$csqu}}.getMinutes()+minutesleft);
        end1_{{$csqu}}.setSeconds(end1_{{$csqu}}.getSeconds()+secondsleft);

        }
        var counter = function () {
        var now = new Date();
        var diff = end1_{{$csqu}} - now;

        diff = new Date(diff);

        var milliseconds = parseInt((diff%1000)/100)
            var sec = parseInt((diff/1000)%60)
            var mins = parseInt((diff/(1000*60))%60)
            //var hours = parseInt((diff/(1000*60*60))%24);

        if (mins < 10) {
            mins = "0" + mins;
        }
        if (sec < 10) {
            sec = "0" + sec;
        }
        if(now >= end1_{{$csqu}}) {
            clearTimeout(interval);
           // localStorage.setItem("end", null);
             localStorage.removeItem("end1_{{$csqu}}");
             localStorage.clear();
            document.getElementById('divCounter').innerHTML = finishedtext;
            //  if(confirm("TIME UP!")){

                 document.getElementById('take-quiz-form-{{$quiz->id}}').submit();
            //  }
        } else {
            var value = mins + ":" + sec;
            localStorage.setItem("end1_{{$csqu}}", end1_{{$csqu}});
            document.getElementById('divCounter').innerHTML = value;
        }
        }
        var interval = setInterval(counter, 1000);


        window.onbeforeunload = function() {

                        return true;

                };

                $('#take-quiz-form-{{$quiz->id}}').on('submit', function(){
                    window.onbeforeunload = null;
                });

    </script>
@endsection
