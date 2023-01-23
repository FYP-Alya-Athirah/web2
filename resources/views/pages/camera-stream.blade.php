@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Camera Scanner'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Cameras</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Camera Stream</p>
                    </div>

                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <!-- <div class="video-container">
                        <img id="stream" src="http://192.168.100.15:81/stream" crossorigin>
                    </div> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-profile">
                                <img id="stream" src="http://192.168.100.15:81/stream" alt="Image placeholder" class="card max-height-500 min-height-500" style="height:auto;width:auto;margin:auto;" crossorigin>
                                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="text-center mt-4">
                                        <h5>
                                            Camera 1</span>
                                        </h5>
                                        <div>
                                            <i class="ni education_hat mr-2"></i>192.168.100.15:81
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-profile">
                                <img id="stream2" src="http://192.168.100.35:8000/stream.mjpg"class="card max-height-500 min-height-500" style="height:auto;width:auto;margin:auto;">
                                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="text-center mt-4">
                                        <h5>
                                            Camera 2</span>
                                        </h5>
                                        <div>
                                            <i class="ni education_hat mr-2"></i>192.168.100.35:8000
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('js')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

@endpush
@push('css')

@endpush
@endsection