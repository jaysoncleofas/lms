@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h3 class="text-oswald">My files</h3>

                <div class="row">
                    <form action="{{route('my_files.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="md-form">
                                <img class="img-fluid img-preview">
                                <div class="file-field">
                                    <div class="btn btn-primary btn-sm float-left">
                                        <span>Choose file</span>
                                        <input type="file" name="file_upload" onchange="previewFile()">
                                    </div>
                                    <div class="file-path-wrapper pr-3">
                                        <input class="file-path" type="text" placeholder="File name" readonly>
                                    </div>
                                </div>

                                @if ($errors->has('file_upload'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file_upload') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="md-form">
                                <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>File Name</th>
                                    <th>Created At</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $key => $file)
                                    <tr>
                                        <td><i class="fa fa-file"></i></td>
                                        <td>{{substr($file->name,11)}}</td>
                                        <td>{{date('F j, Y',strtotime($file->created_at))}}</td>
                                        <td>
                                            <a href="{{route('my_files.download', $file->id)}}" class="blue-text">Download</a>
                                        </td>
                                        <td>
                                            <a  class="text-danger" onclick="if(confirm('Are you sure you want to delete this file?')) {
                                                        event.preventDefault();
                                                        $('#delete-file-form-{{$file->id}}').submit();
                                                      }">
                                                Delete
                                            </a>
                                            <form id="delete-file-form-{{$file->id}}" action="{{ route('my_files.destroy', $file->id) }}" method="post">
                                              @csrf {{method_field('DELETE')}}

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('partials.notification')
@endsection
