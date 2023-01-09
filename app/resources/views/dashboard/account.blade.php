<?php
/** @var \App\ModelsExtended\Account $account */
?>
@extends('layouts.simple.master')

@section('title', 'Account')

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">

    <!-- dataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/members.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">


@endsection

@section('style')
    <style>
        .img-content-box {
            display: flex;
        }
        #uploadModalDemo {
            width: 100%;
            height: 350px;
            padding-bottom: 25px;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .uploadPhotoPreview {
            border-radius: 100%;
            width: 80px;
            height: 80px;
        }

        .uploadPhotoPreview:hover {
            cursor: pointer;
        }

        .addContactCancelBtn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 8px 16px;
            margin: 0px 20px;
            width: 250px;
            height: 54px;

            border: 1px solid #D9D9D9;
            border-radius: 8px;
            font-family: 'Lato';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 21px;
            /* identical to box height, or 175% */

            text-align: center;
            letter-spacing: 0.11em;
            text-transform: uppercase;

            color: #636266;
        }

        .addContactBtn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 8px 16px;

            width: 250px;
            height: 54px;

            /* Buttons */

            background: #4D5997;
            border-radius: 8px;

            font-family: 'Lato';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 21px;
            /* identical to box height, or 175% */

            text-align: center;
            letter-spacing: 0.11em;
            text-transform: uppercase;

            color: #FFFFFF;
        }

    </style>
@endsection
@section('breadcrumb-title')
    <h3>Account</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Account</li>
@endsection

@section('content')
    <div class="container-fluid members-listing px-4">
        <div class="row second-chart-list third-news-update">
            <div class="xl-100 morning-sec box-col-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border card-no-padding-bottom">
                        <div class="header-top">
                            <h5 class="m-0 text-default">Personal Information</h5>
                        </div>
                    </div>
                    <div class="card-body" style="min-height:300px">
                        <div class="profile-table table-responsive">
                            <table class="table table-bordernone">
                                <tbody>
                                    <tr>
                                        <form method="post" action="{{ route('editAvatar') }}" id="addnewContactFrom"
                                            enctype="multipart/form-data">
                                        @csrf

                                        <td class="profile-image-info-container">
                                            <h6 class="label-small">profile picture</h6>
                                            <img class="img-fluid img-80 rounded-circle mt-12"
                                                src="{{ !empty($user->image_url) ? $user->image_url : asset('assets/images/dashboard/profile.jpg') }}"
                                                alt="blank profile image">
                                        </td>
                                        <td class="img-content-box profile-image-edit-btn-wrapper">
                                            <span class="text-default edit-img-btn"><img class="edit-icon"
                                                src="{{ asset('assets/images/edit-2.svg') }}"
                                                alt="edit icon"></i>Edit</span>
                                        </td>
                                        <td class="profile-image-upload-container" style="display: none;">
                                            <h6 class="label-small">profile picture</h6>
                                            <div class="uploadPhotoPreview">
                                                <label class="cabinet">
                                                    <img src="" class="img-responsive uploadPhotoPreview" id="item-img-output"/>
                                                    <input type="file" class="item-img file" name="imageDemo" style="display:none"/>
                                                    <input type="file" id="mainImageInput" name="image" style="display:none"/>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="img-content-box image-btn-list-wrapper" style="display: none;">
                                            <span class="text-default cancel-img-btn">Cancel</span>
                                            <button class="upload-result" type="submit">Save</button>
                                        </td>
                                        </form>
                                    </tr>
                                    <tr>
                                        <td class="profile-info-wrapper" >
                                            <h6 class="label-info-text">Name</h6>
                                            <p class="profile-info-text profile-name-info">{{Auth::user() ? Auth::user()->name : '' }}</p>
                                        </td>
                                        <td class="img-content-box edit-icon-wrapper">
                                            <span class="text-default edit-btn"><img class="edit-icon"
                                                src="{{ asset('assets/images/edit-2.svg') }}"
                                                alt="edit icon">Edit</span>
                                        </td>
                                        <td class="profile-form-wrapper" style="display: none;">
                                            <div>
                                                <h6 class="label-info-text">First Name*</h6>
                                                <input type="text" value="{{Auth::user() ? Auth::user()->first_name : '' }}" name="first_name" id="first_name" class="profile-form-input">
                                            </div>
                                            <div style="margin-left: 26px;">
                                                <h6 class="label-info-text">Last Name*</h6>
                                                <input type="text" value="{{Auth::user() ? Auth::user()->last_name : '' }}" name="last_name" id="last_name" class="profile-form-input">
                                            </div>
                                        </td>
                                        <td class="img-content-box btn-list-wrapper" style="display: none;">
                                            <span class="text-default cancel-btn">Cancel</span>
                                            <button class="save-btn">Save</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="label-info-text">Role</h6>
                                            <p class="profile-info-text">{{ Auth::user()->role ? Auth::user()->role->description : ''}}</p>
                                        </td>
                                        <td class="img-content-box">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="photoREsizeModal"
             aria-hidden="true">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-loto" id="photoREsizeModal">
                            Crop image and upload</h4>
                    </div>
                    <div class="modal-body">
                        <p class="font-loto"></p>
                        <div id="uploadModalDemo"></div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn m-0 addContactCancelBtn"
                                onclick="javascript:void($('#cropImagePop').modal('hide'))" data-dismiss="modal">Cancel
                        </button>
                        <button type="button" id="cropImageBtn" class="btn btn-primary addContactBtn">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid members-listing px-4">
        <div class="row second-chart-list third-news-update">
            <div class="xl-100 morning-sec box-col-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border card-no-padding-bottom">
                        <div class="header-top">
                            <h5 class="m-0 text-default">Contact Information</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-table table-responsive">
                            <table class="table table-bordernone">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="label-info-text">Email</h6>
                                            <p class="profile-info-text">{{Auth::user() ? Auth::user()->email : '' }}</p>
                                        </td>
                                        <td class="img-content-box d-flex">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var session_layout =
            '{{ session()->get('
                                                                                                                                                                                                                                                                                                                                                                                                                layout ') }}';
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

    <script src='https://foliotek.github.io/Croppie/croppie.js'></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        setTimeout(function() {
            $('#success-meg').fadeOut('fast');
        }, 4000);
    </script>

    

    <script>
        $(document).ready(function () {

            function dataURLtoFile(dataurl, filename) {

                var arr = dataurl.split(','),
                    mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]),
                    n = bstr.length,
                    u8arr = new Uint8Array(n);

                while (n--) {
                    u8arr[n] = bstr.charCodeAt(n);
                }

                return new File([u8arr], filename, {
                    type: mime
                });
            }

            $(".uploadPhotoPreview").attr("src", "{{ asset('assets/images/avtar/account-avatar-blank.svg') }}");
            var $uploadCrop,
                tempFilename,
                rawImg,
                imageId;

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.upload-demo').addClass('ready');
                        $('#cropImagePop').modal('show');
                        rawImg = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    swal("Sorry - you're browser doesn't support the FileReader API");
                }
            }

            $uploadCrop = $('#uploadModalDemo').croppie({
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'circle'
                },
                enforceBoundary: false,
                enableExif: true
            });
            $('#cropImagePop').on('shown.bs.modal', function () {
                // alert('Shown pop');
                $uploadCrop.croppie('bind', {
                    url: rawImg
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            });

            $('.item-img').on('change', function () {
                imageId = $(this).data('id');
                tempFilename = $(this).val();
                $('#cancelCropBtn').data('id', imageId);
                readFile(this);
            });
            $('#cropImageBtn').on('click', function (ev) {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (resp) {
                    $('#item-img-output').attr('src', resp);
                    $('#cropImagePop').modal('hide');
                    var file = dataURLtoFile(resp, "test.png");
                    let container = new DataTransfer();
                    container.items.add(file);
                    document.querySelector('#mainImageInput').files = container.files;
                    var newfile = document.querySelector('#mainImageInput').files[0];
                });
            });
            // End upload preview image
        });
    </script>

    <script>
        @if ($message = session('success'))
            swal("{!! session()->get('success') !!}");
        @endif
    </script>

    <script>

        
        $(".edit-btn").click(function () {
            $(".edit-icon-wrapper").hide();
            $(".profile-info-wrapper").hide();
            $(".profile-form-wrapper").show();
            $(".btn-list-wrapper").show();
        });
        $(".cancel-btn").click(function () {
            $(".edit-icon-wrapper").show();
            $(".profile-info-wrapper").show();
            $(".profile-form-wrapper").hide();
            $(".btn-list-wrapper").hide();
        });
        $(".save-btn").click(function () {
            var firstName = $("#first_name").val();
            var lastName = $("#last_name").val();
            $.ajax({
                url: "/account/edit-name?first_name=" + firstName + "&last_name=" + lastName,
                method: "GET",
                beforeSend: function () {
                    console.log(firstName);
                    console.log(lastName);
                },
                success: function (data) {
                    $(".profile-name-info").html(firstName + ' ' + lastName);
                },
                complete: function () {
                    $(".edit-icon-wrapper").show();
                    $(".profile-info-wrapper").show();
                    $(".profile-form-wrapper").hide();
                    $(".btn-list-wrapper").hide();
                },
            });
        });
        $(".edit-img-btn").click(function () {
            $(".profile-image-edit-btn-wrapper").hide();
            $(".profile-image-info-container").hide();
            $(".profile-image-upload-container").show();
            $(".image-btn-list-wrapper").show();
        });
        $(".cancel-img-btn").click(function () {
            $(".profile-image-edit-btn-wrapper").show();
            $(".profile-image-info-container").show();
            $(".profile-image-upload-container").hide();
            $(".image-btn-list-wrapper").hide();
        });

        $("#addnewContactFrom").validate({
            rules: {
                image: {
                    required: false,
                    extension: "jpg|jpeg|png|PNG|gif"
                }
            },
                    
            highlight: function (element, errorClass) {
                $(element).removeClass(errorClass); //prevent class to be added to selects
            },
            submitHandler: function (form, event) {
                // form.submit();
                event.preventDefault();
                var formData = new FormData(form);
                var url = $('#addnewContactFrom').attr('action');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: url,
                    data: formData,
                    async: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {

                        if (data.status == 200) {
                            swal({
                                title: "Success",
                                text: data.message,
                                type: "success"
                            }).then(function () {
                                window.location = "/account";
                            });
                        } else {
                            swal({
                                title: "Error",
                                text: data.message,
                                type: "error"
                            }).then(function () {
                                window.location = "/account";
                            });
                        }
                    },
                    error: function (data) {
                        var response = data.responseJSON;
                        $.each(response.errors, function (key, value) {
                            $('.error_' + key).html(value)
                        });
                    }
                })
            }
        })
    </script>
@endsection
