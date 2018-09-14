@extends('layouts.app')

@section('styles')
    <style media="screen">
        .mdb-feed {
            margin: 0 !important
        }
    </style>
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
                </nav>
            </div>
        </div>
        <div class="row mt-lg-3 justify-content-center">
            <div class="col-xl-12 col-md-12 mb-5 pb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email Address<th>
                            <th>Roles</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{$section->instructor->firstName}} {{$section->instructor->lastName}}</td>
                            <td>{{$section->instructor->email}}</td>
                            <td class="text-capitalize">{{$section->instructor->role}}</td>
                            <td><a class="blue-text" data-toggle="modal" data-target="#basicExampleModal">Message</a></td>
                        </tr>
                        @foreach ($section->users as $key => $student)
                            <tr>
                                <td>{{$key+2}}</td>
                                <td>{{$student->firstName}} {{$student->lastName}}</td>
                                <td>{{$student->email}}</td>
                                <td class="text-capitalize">{{$student->role}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Message to {{$section->instructor->firstName}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('message.store')}}">
          {{ csrf_field() }}
          <div class="modal-body">
            <input type="hidden" name="to_user_id" value="{{$section->instructor->id}}" class="form-control" id="recipient-name">
            <div class="md-form mt-0">
              <textarea type="text" placeholder="Message" name="message" id="message-text" class="form-control md-textarea" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send message</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
