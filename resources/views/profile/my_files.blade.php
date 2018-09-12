@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h3 class="text-oswald">My files</h3>   

                <div class="row">
                    <form action="" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Created Add</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="" class="blue-text">Download</a>
                                    </td>
                                </tr>
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
