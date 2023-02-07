@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Child Photos Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Photos</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Photos</p>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="container">  
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                        <div class="panel-body">
                        
                            @if ($message = Session::get('success'))
                            <!-- <div class="alert alert-success alert-block">
                                <button type="button" class="btn-close p-0 fixed-plugin-close-button" data-dismiss="alert"></button>
                                    <strong>{{ $message }}</strong>
                            </div> -->

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-text"><strong>{{ $message }}</strong></span>
                                <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('photo-upload-child/'.$id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>
                                </div>
                            </form>
                        
                        </div>
                        </div>
                    </div>
                    <!-- Array of photos from database -->
                    <div class="row">
                    @foreach ($photos as $photo)
                        <div class="col-md-4">
                            <div class="card card-profile min-height-500 min-width-400">
                                <img src="{{ url('/images/'.$photo->path) }}" class="max-height-300 max-width-300" style="height:auto;width:auto;margin:auto;">
                                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                                </div>
                                <div class="card-footer pt-0">
                                    <div class="text-center mt-4">
                                        <a class="btn btn-danger btn-xs" style="float: right;" href="{{url('/photo-delete/'.$photo->path) }}" role="button" id="deleteButton">
                                            <img border="0" src="{{ asset('/img/icons/garbage.png') }}" width="20" height="20">
                                        </a>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @if ($message = Session::get('success'))
                    @endif
                </div>
            </div>
        </div>
    </div>
@push('js')


@endpush
@push('css')

@endpush
@endsection
