@extends('layouts.simple.master')

@section('title', (@$vendor->id) ? 'Update supplier' : 'Add new supplier')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/library.css')}}">
    {{-- <link rel="stylesheet" href="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.css"> --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/@yaireo/tagify/dist/tagify.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <meta name="_token" content="{{csrf_token()}}"/>
@endsection
@section("meta")
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('style')
    <style>
        .add-new-suplier {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .required::after {
            content: '*';
            color: red;
            font-size: 18px;
            margin-left: 3px;
        }

        .backBtn {
            display: flex;
            margin-bottom: 30px;
        }

        .backBtn a {
            text-transform: uppercase;
            font-weight: 700;
            font-size: 14px;
            margin-left: 3px;
            line-height: 27px;
        }

        #activeCategory {
            background: rgba(77, 89, 151, 0.1) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            font-family: "Lato" !important;
            font-style: normal !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            line-height: 21px !important;
            text-align: center;
            color: #4d5997 !important;
        }

        .tagify tag {
            background: #4D5997 !important;
            color: white !important;
            border-radius: 100px !important;
        }

        .tagify .tagify__tag-text {
            color: white !important;
        }

        .tagify x {
            color: white !important;
        }

        .tagify x:hover {
            background: #4D5997 !important;
        }

        .tagify__tag > div::before {
            inset: unset !important;
        }

        .vendor_logo {
            width: 140px;
            height: 140px;
            /*opacity: 0.1;*/
            border: 1px solid #dddddd;
            border-radius: 50%;
            position: relative;
        }

        .vendor_logo_main {
            position: relative;
            height: 140px;
            width: 140px;
            text-align: center;
        }

        span.upload {
            position: absolute;
            opacity: 1;
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%);
        }

        span.cam {
            position: absolute;
            bottom: 10px;
            right: 0px;
            cursor: pointer;
            z-index: 55;
        }

        #img-upload-logo {
            width: 140px;
            height: 140px;
            object-fit: cover !important;
            position: relative;
            border-radius: 100px;
            left: -1px;
            top: -1px;

        }

        .multi-img-option {
            border: 2px solid #dddddd;
            padding: 20px;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .upload__img-box {
            width: 180px;
            position: relative;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            right: 2px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        /*.upload__img-close:after {*/
        /*    content: "✖";*/
        /*    font-size: 14px;*/
        /*    color: white;*/
        /*}*/

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }

    </style>
@endsection

@section('breadcrumb-title')
    <h3>Library</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">{{ (@$vendor->id) ? 'Update supplier' : 'Add new supplier' }}</li>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="xl-100 box-col-12">
                <div class="card o-hidden">

                    <div class="card-body">
                        <div class="backBtn">
                            <span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 12H5" stroke="#4D5997" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M12 19L5 12L12 5" stroke="#4D5997" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                             </span>
                            <a href="{{ URL::previous() }}">back</a>
                        </div>

                        <form method="post" action="{{ route("save_library") }}" id="vendorForm">
                            <div class="mb-4 add-new-suplier ">
                                <h3 class="fw-bold"
                                    style="margin-bottom: 0px">{{ (@$vendor->id) ? 'Update supplier' : 'Add new supplier' }}</h3>
                                <button id="btnSubmit" class="btn btn-primary add-asset"
                                        type="submit"> {{ (@$vendor->id) ? 'UPDATE SUPPLIER' : 'SAVE' }}
                                </button>
                            </div>
                            @csrf
                            <input type="hidden" name="vendor_id" id="vendor_id" value="{{@$vendor->id}}">
                            <div>
                                <p class="required">TYPE</p>
                                <div class="btn-group container-fluid p-0 btn-group-vategory">
                                    @php

                                        $default_category = count($categories) > 0 ? $categories->first()->id : "";
                                            if(@$vendor){
                                               $default_category = ($vendor->asset_category_id ) ? $vendor->asset_category_id : "";
                                            }

                                    @endphp

                                    @if(@$vendor->id != null)
                                        <button
                                            class="nav-link btn border py-3 rounded text-capitalize font-loto fs-6 category btn-primary active-category active "
                                            data-id="{{ $default_category }}"
                                            id="activeCategory"
                                            type="button">{{ $vendor->asset_category->description }}</button>
                                    @else
                                        @foreach($categories as $category)
                                            <button
                                                class="btn border py-3 rounded text-capitalize fs-6 category{{ old("asset_category_id", $default_category) == $category->id ? " active btn-primary active-category" : ""}}"
                                                data-id="{{ $category->id }}"
                                                type="button">{{ $category->description  }}</button>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="hidden" name="asset_category_id" id="asset_category_id"
                                       class="form-control" value="{{ old("asset_category_id", $default_category) }}"/>
                                <div class="asset_category_id invalid-feedback"></div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="name" class="mt-4 text-uppercase required">Supplier
                                                name:</label>
                                            <input type="text" name="name" id="name" class=" supplier_name form-control"
                                                   value="{{ old("name", @$vendor->name) }}">
                                            <div class="name invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="name" class="mt-4 text-uppercase required">Alias:</label>
                                            <input type="text" name="alias" id="alias" class="form-control"
                                                   value="{{ old("alias", @$vendor->alias) }}">
                                            <div class="alias invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="address" class="mt-4  text-uppercase required">Address:</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                   value="{{ old("address", @$vendor->address) }}">
                                            <div class="address invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="address" class="mt-4  text-uppercase">timezone:</label>
                                            <select class="form-control form-select timezone" name="timezone" id="timezone" >
                                                <option value="">Select timezone</option>
                                                @foreach($timezones as $timezone)
                                                    <option value="{{ $timezone['id'] }}" {{ (@$vendor->timezone_id == $timezone['id']) ? 'selected' : '' }}>{{ $timezone['description'] }}</option>
                                                @endforeach
                                            </select>
                                            <div class="timezone invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="phone" class="mt-4  text-uppercase">Phone:</label>
                                            <input type="text" name="phone" id="phone" class="form-control"
                                                   value="{{ old("phone",  @$vendor->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 ">
                                        <div class="form-group">
                                            <label for="email" class="mt-4  text-uppercase">Email:</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                   value="{{ old("email", @$vendor->email) }}">
                                            <div class="email invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="tags" class="mt-4 text-uppercase">Tags:</label>
                                            <input type="text" name="tags" id="tags" class="form-control"
                                                   value="{{ old("tags", @$vendor->tags) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="mt-4 text-uppercase" for="description">Description:</label>
                                            <textarea class="form-control" style="height: 90px !important;" rows="4"
                                                      name="description"
                                                      id="description">{{ old("description", @$vendor->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="status" class="mt-4 text-uppercase">Logo:</label>

                                        <div class="vendor_logo_main">
                                            <span class="cam">
                                                <img src="{{ asset('assets/images/cam.svg') }}">
                                            </span>
                                            <span class="upload">
                                                <svg width="46" height="32" viewBox="0 0 46 32" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.08"
                                                      d="M10.2614 31.7041C4.63635 31.7041 0.136353 27.2041 0.136353 21.5791C0.136353 17.2197 2.94885 13.4229 6.88635 12.0869C6.88635 11.876 6.88635 11.665 6.88635 11.4541C6.88635 5.2666 11.8785 0.204102 18.1364 0.204102C22.2848 0.204102 25.941 2.52441 27.8395 5.89941C28.8942 5.12598 30.2301 4.7041 31.6364 4.7041C35.3629 4.7041 38.3864 7.72754 38.3864 11.4541C38.3864 12.3682 38.1754 13.1416 37.8942 13.915C42.0426 14.7588 45.1364 18.415 45.1364 22.7041C45.1364 27.6963 41.0582 31.7041 36.1364 31.7041H10.2614ZM15.816 16.4463C15.1129 17.1494 15.1129 18.2041 15.816 18.8369C16.4489 19.54 17.5035 19.54 18.1364 18.8369L20.9489 16.0947V25.5166C20.9489 26.501 21.652 27.2041 22.6364 27.2041C23.5504 27.2041 24.3239 26.501 24.3239 25.5166V16.0947L27.066 18.8369C27.6989 19.54 28.7535 19.54 29.3864 18.8369C30.0895 18.2041 30.0895 17.1494 29.3864 16.4463L23.7614 10.8213C23.1285 10.1885 22.0739 10.1885 21.441 10.8213L15.816 16.4463Z"
                                                      fill="black"/>
                                                </svg>
                                            </span>
                                            <div class="vendor_logo">
                                                <input type="file" name="logo" id="logo-upload" style="display: none">
                                                @if(isset($vendor->logo))
                                                    <img src="{{ $vendor->logo->image_url }}" id="img-upload-logo"
                                                         width="150px"
                                                         class="  @if(!isset($vendor->logo)) d-none @endif"/>
                                                @else
                                                    <img src="" id="img-upload-logo" width="150px" class="d-none"/>
                                                @endif
                                            </div>
                                            <span class="image-name"></span><br>
                                            <a class="dz-remove-logo @if(!isset($vendor->logo)) d-none @endif"
                                               data-id="@if(isset($vendor->logo)){{ $vendor->logo->id }}@endif"
                                               href="javascript:void(0);">Remove file</a>

                                        </div>

                                    </div>

                                    <div class="col-sm-8">
                                        <label for="status" class="mt-4 text-uppercase">Photos:</label>
                                        <div class="images-list">
                                            <div class="upload__box">
                                                <div class="upload__btn-box">
                                                    <input type="file" name="photos[]" multiple="" data-max_length="20"
                                                           id="upload__inputfiles" class="upload__inputfile">
                                                </div>
                                                <div class="upload__img-wrap">
                                                    @if(isset($vendor->images))
                                                        @foreach($vendor->images as $key => $image)
                                                            <div class="upload__img-box">
                                                                <div
                                                                    style="background-image: url({{ $image->image_url }})"
                                                                    data-id="{{ $image->id }}" data-number="{{ $key }}">
                                                                    <div class='upload__img-close'>
                                                                        <img
                                                                            src='{{ asset('assets/images/close.svg') }}'>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div id="vendor-img"
                                                 class="multi-img-option dz-message d-flex flex-column align-items-center justify-content-center">
                                                <i class="uploadIcon" data-feather="upload-cloud"></i>
                                                <span
                                                    class="dropzoneHelpMsg">Upload upto 6 images. Max file size 2MB</span>

                                            </div>
                                        </div>

                                    </div>
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

            {{-- <script src="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script> --}}
            <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
            <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
            <script src="https://unpkg.com/@yaireo/tagify"></script>

            <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>
            <script src="{{ asset("js/create-vendor.js") }}"></script>


            <script>
                jQuery(document).ready(function () {
                    ImgUpload();
                });

                function ImgUpload() {
                    var imgWrap = "";
                    var imgArray = [];
                    const dataTransfer = new DataTransfer();
                    $('.upload__inputfile').each(function () {
                        $(this).on('change', function (e) {

                            imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                            var maxLength = $(this).attr('data-max_length');

                            var files = e.target.files;
                            var filesArr = Array.prototype.slice.call(files);
                            var iterator = 0;


                            for (let file of files) {
                                dataTransfer.items.add(file);
                            }
                            filesArr.forEach(function (f, index) {

                                if (!f.type.match('image.*')) {
                                    return;
                                }

                                if (imgArray.length > maxLength) {
                                    return false
                                } else {
                                    var len = 0;
                                    for (var i = 0; i < imgArray.length; i++) {
                                        if (imgArray[i] !== undefined) {
                                            len++;
                                        }
                                    }
                                    if (len > maxLength) {
                                        return false;
                                    } else {
                                        imgArray.push(f);

                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'><img src='{{ asset('assets/images/close.svg') }}'></div></div></div>";
                                            imgWrap.append(html);
                                            iterator++;
                                        }
                                        reader.readAsDataURL(f);
                                        document.getElementById('upload__inputfiles').files = dataTransfer.files
                                    }
                                }
                            });
                        });
                    });

                    $('body').on('click', ".upload__img-close", function (e) {
                        var file = $(this).parent().data("file");
                        let image_id = $(this).parent().data("id");
                        for (var i = 0; i < imgArray.length; i++) {
                            if (imgArray[i].name === file) {
                                dataTransfer.items.remove(i);
                                imgArray.splice(i, 1);
                                document.getElementById('upload__inputfiles').files = dataTransfer.files
                                break;
                            }
                        }
                        $(this).parent().parent().remove();
                        let deleteBackend = '';
                        if (image_id != null) {
                            imageDelete(image_id)
                        }
                        if (image_id == null) {
                            $.notify(
                                {
                                    message: "Vendor image has been deleted.",
                                },
                                {
                                    type: "success",
                                }
                            );
                        }
                    });
                }


                document.getElementById("vendor-img").addEventListener("click", myFunction);
                const dataTransferLogo = new DataTransfer();

                function myFunction() {
                    $('.upload__inputfile').click();
                }

                $('.cam img').click(function () {
                    $('#logo-upload').click();
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        dataTransferLogo.clearData();
                        dataTransferLogo.items.add(input.files[0]);
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#img-upload-logo').attr('src', e.target.result);
                            $('#img-upload-logo').removeClass('d-none')
                            $('.dz-remove-logo').removeClass('d-none')
                            $('.image-name').html(input.files[0].name)
                        }
                        reader.readAsDataURL(input.files[0]);
                        document.getElementById('logo-upload').files = dataTransferLogo.files


                    }
                }

                $("#logo-upload").change(function () {
                    readURL(this);
                });

                $(document).on('click', '.dz-remove-logo', function () {
                    let logo_id = $(this).data('id');
                    let logo = $(this).parent().find('#img-upload-logo');
                    let logo_name = $('.image-name').text();
                    logo.removeAttr('src');
                    logo.addClass('d-none');
                    $('.dz-remove-logo').addClass('d-none');
                    $('.image-name').html(' ');
                    dataTransferLogo.clearData();
                    if(logo_id){
                        imageDelete(logo_id)
                    }
                })

                function imageDelete(image_id)
                {
                    $.ajax({
                        url: '/library/delete/image/' + image_id,
                        type: 'get',
                        success: function (response) {

                            if (response.success) {
                                $.notify(
                                    {
                                        message: "Vendor image has been deleted.",
                                    },
                                    {
                                        type: "success",
                                    }
                                );

                            }
                        }
                    });
                }
            </script>
@endsection
