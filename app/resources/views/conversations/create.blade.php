@extends('layouts.simple.master')

@section('title', 'Add new supplier')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/library.css')}}">
<link rel="stylesheet" href="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Library</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Add new supplier</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="mb-4 ">
        <h3 class="fw-bold">Add new supplier</h3>
    </div>
    <div class="row">
        <div class="xl-100 box-col-12">
            <div class="card o-hidden">

                <div class="card-body">
                    <div>
                        <p>TYPE</p>
                        <div class="btn-group container-fluid p-0">
                            <button
                                class="btn border py-3 rounded text-capitalize fs-6 category active btn-primary active-category"
                                data-id=" 1">Accommodation</button>
                            <button type="button" class="btn border py-3 rounded text-capitalize fs-6 category"
                                data-id="2">Dining</button>
                            <button type="button" class="btn border py-3 rounded text-capitalize fs-6 category"
                                data-id="3">Event</button>
                            <button type="button" class="btn border py-3 rounded text-capitalize fs-6 category"
                                data-id="4">Event
                                Package</button>
                        </div>
                    </div>
                    <form method="post" id="asset-form">
                        <div class="form-group">

                            <div class="row">
                                <div class="col-sm-6 ">
                                    <label for="venue" class="mt-4 text-uppercase">Supplier name:</label>
                                    <input type="text" required name="venue" class="form-control" id="venue">
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="address" class="mt-4  text-uppercase">Address:</label>
                                    <input type="text" name="address" class="form-control" id="address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <label for="seller" class="mt-4  text-uppercase">Phone:</label>
                                    <input type="text" name="seller" class="form-control" id="seller">
                                </div>
                                <div class="col-sm-6 ">
                                    <label for="status" class="mt-4  text-uppercase">Email:</label>
                                    <input type="text" name="status" class="form-control" id="status">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="name" class="mt-4  text-uppercase">Tags:</label>
                                    <input type="name" required name="name" class="form-control" id="name">
                                    <input type="hidden" name="id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="mt-4  text-uppercase">Description:</label>
                                    <textarea class="form-control" style="height: 90px !important;" rows="4"
                                        name="description" id="description"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="seller" class="mt-4 text-uppercase">Logo:</label>
                                    <div id="logoupload-dropzone" class="dropzone">
                                        <div
                                            class="dz-message d-flex flex-column align-items-center justify-content-center">
                                            <i class="uploadIcon" data-feather="upload-cloud"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8 ">
                                    <label for="status" class="mt-4  text-uppercase">Photos:</label>
                                    <div id="photoupload-dropzone" class="dropzone">
                                        <div
                                            class="dz-message d-flex flex-column align-items-center justify-content-center">
                                            <i class="uploadIcon" data-feather="upload-cloud"></i>
                                            <span class="dropzoneHelpMsg">Upload upto 6 images. Max file size 2MB</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary mt-4 add-asset " type="button">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    var session_layout = '{{ session()->get('
    layout ') }}';
    </script>
    @endsection

    @section('script')

    <script src="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script>
    $(document).ready(function() {
        $(".category").on('click', function() {
            var _this = $(this);
            $(".category").removeClass("active");
            $(".category").removeClass("btn-primary");
            $(".category").removeClass("active-category");
            _this.addClass("active");
            _this.addClass("btn-primary");
            _this.addClass("active-category");
        });

        $("div#photoupload-dropzone").dropzone({
            url: "/file/post"
        });
        $("div#logoupload-dropzone").dropzone({
            url: "/file/post"
        });
    });
    </script>




    @endsection
