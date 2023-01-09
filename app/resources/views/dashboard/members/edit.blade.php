@extends('layouts.simple.master')

@section('title', 'Edit Contact')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">
<link rel='stylesheet' href='https://foliotek.github.io/Croppie/croppie.css'>
@endsection

@section('style')
<style>
.bootstrap-tagsinput {
    width: 100%;
    border-radius: 0;
    height: 45px;
    padding-left: 2.375rem;
    display: flex;
    align-items: center;
}

.bootstrap-tagsinput .tag {
    font-size: 14px;
    padding: 5px;
    font-family: 'Lato';
    font-style: normal;
}

.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.9rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
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


label.cabinet {
    display: block;
    cursor: pointer;
}

label.cabinet input.file {
    position: relative;
    height: 100%;
    width: auto;
    opacity: 0;
    -moz-opacity: 0;
    margin-top: -30px;
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
    width: 150px;
    height: 150px;
}

figcaption {
    position: absolute;
    bottom: 0;
    padding-left: 98px;
    padding-bottom: 5px;
    z-index: 7;
}

figcaption i {
    background: #4D5997;
    padding: 10px;
    border-radius: 100%;
    color: #fff;
            border: 2px solid #ffffff;
}
</style>
@endsection

@section('breadcrumb-title')
<h3>Members</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item "><a href="{{ route('members')}}">Members</a></li>
<li class="breadcrumb-item active">Edit Contact</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="xl-100 morning-sec box-col-12">
            <div class="card o-hidden">
                <div class="card-body">
                    <form method="post" id="contactEditForm" action="{{ route('members.update', $member->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between">
                                <h6 class="f-w-700">EDIT CONTACT</h6>
                                <!-- <div class="media justify-content-end"><img
                                        class="img-100 img-fluid m-r-20 rounded-circle update_img"
                                        src="{{ !empty($member->image_relative_url) ? Storage::disk('s3')->url($member->image_relative_url) : asset('assets/images/avtar/avatar-placeholder.jpg') }}"
                                        alt="">
                                    <input class="updateimg" type="file" name="image" onchange="readURL(this,0)">
                                </div> -->

                                <div class="uploadPhotoPreview">
                                    <label class="cabinet">
                                            <img
                                                src="{{ !empty($member->image_url) ? $member->image_url : asset('assets/images/avtar/avatar-placeholder.jpg') }}"
                                                class="img-responsive uploadPhotoPreview" id="item-img-output"/>
                                        <figcaption><i class="fa fa-camera"></i></figcaption>
                                            <input type="file" class="item-img file" name="image"/>
                                            <input type="file" id="mainImageInput" name="image" style="display:none"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">FIRST NAME: *</label>
                                <input class="form-control f-sf-pro" type="text" name="first_name"
                                    value="{{ $member->first_name }}" required>
                                <span class="text-danger error_first_name f-sf-pro"></span>

                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">LAST NAME: *</label>
                                <input class="form-control f-sf-pro" type="text" name="last_name"
                                    value="{{ $member->last_name }}" required>

                                <span class="text-danger error_last_name f-sf-pro"></span>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label">PHONE: *</label>
                                <input class="form-control f-sf-pro" type="tel" name="msisdn"
                                    placeholder="e.g. 1800001111" value="{{ $member->msisdn }}" required
                                           maxlength="30"/>

                                <span class="text-danger error_msisdn f-sf-pro"></span>

                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">EMAIL</label>
                                <input class="form-control f-sf-pro" type="text" name="email"
                                    value="{{ $member->email ?? '' }}">

                                <span class="text-danger error_email"></span>

                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">ZIP OR POSTAL CODE: *</label>
                                <input class="form-control f-sf-pro" type="text" name="zipcode"
                                    value="{{ $member->zipcode }}" required>

                                <span class="text-danger error_zipcode f-sf-pro">{{ $errors->first('zipcode') }}</span>

                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">STATUS: *</label>
                                <select class="form-control f-sf-pro" name="member_status_id" required>
                                    @foreach ($statuses as $status)
                                            <option
                                                value="{{ $status->id }}" @if ($member->member_status_id == $status->id)
                                                {{ 'selected' }}
                                                @endif>
                                        {{ $status->description }}</option>
                                    @endforeach
                                </select>

                                <span class="text-danger error_member_status_id f-sf-pro"></span>

                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="form-label f-sf-pro">INTERESTS</label>
                                <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control f-sf-pro" id="tags_interest"
                                        name="interests">
                                </div>
                            </div>
                                <div class="col-md-12 mt-4">
                                    <label class="form-label f-sf-pro">Groups</label>
                                    <div class="form-group has-search">
                                        <span class="fa fa-search form-control-feedback"></span>
                                        <input type="text" class="form-control f-sf-pro" id="tags_groups"
                                               name="groups">
                                    </div>
                                </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn btn-primary mt-4" value="" type="submit">Update
                                    Contact</button>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end ">
                                <a href="{{ route('members')}}" class="btn mt-4 addContactCancelBtn">Cancel</a>
                                <button class="btn btn-primary mt-4 addContactBtn" type="submit">Update
                                        Contact
                                    </button>
                            </div>
                        </div>
                    </form>
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
<script type="text/javascript">
var session_layout = '{{ session()->get('
layout ') }}';

function readURL(input) {
    // console.log(input.files[0]);
    var elems = document.getElementsByClassName('update_img');
    for (i = 0; i < elems.length; i++) {
        elems[i].src = window.URL.createObjectURL(input.files[0]);
    }
};
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
        $(document).ready(function () {
    var interests = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace("interest"),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: JSON.parse('{!! json_encode($interests) !!}')

    });
    interests.initialize();

    $('#tags_interest').tagsinput({
        typeaheadjs: {
            name: "interests",
            displayKey: "interest",
            valueKey: 'interest',
            source: interests.ttAdapter()
        }
    })

            var groups = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: JSON.parse('{!! json_encode($groups) !!}')

            });

            groups.initialize();
            $('#tags_groups').tagsinput({
                typeaheadjs: {
                    name: "groups",
                    displayKey: "name",
                    valueKey: 'name',
                    source: groups.ttAdapter()
                }
            })

    // insert data to input in load page
    var selectedInterest = JSON.parse('{!! json_encode($member->member_interests) !!}');
    selectedInterest.forEach(async (item) => {
        $('#tags_interest').tagsinput("add", item.interest, {
            preventPost: true
        });
    });

            // insert data to input in load page
            var selectedGroups = JSON.parse('{!! json_encode($member->member_groups) !!}');
            selectedGroups.forEach(async (item) => {
                $('#tags_groups').tagsinput("add", item.contact_group.name, {
                    preventPost: true
                });
            });

    if ($("#contactEditForm").length > 0) {
        // Suppose that your method is well defined

        jQuery.validator.addMethod("validatePhone",
                    function (value, element) {
                var valid;
                if ($.trim(value).length > 0) {
                    var regx = /[0-9]{10,15}/;
                    valid = regx.test(value);
                } else {
                    valid = true;
                }
                return this.optional(element) || valid;
            }, "Please enter valid phone number"
        );


        $("#contactEditForm").validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 250
                },
                last_name: {
                    required: true,
                    maxlength: 250
                },
                email: {
                    required: false,
                    email: true,
                    maxlength: 250
                },
                msisdn: {
                    required: true,
                    validatePhone: true,
                    maxlength: 20
                },
                zipcode: {
                    required: true,
                    maxlength: 10
                },
                member_status_id: {
                    required: true,
                },
                image: {
                    required: false,
                    extension: "jpg|jpeg|png|PNG|gif"
                }
            },
            messages: {
                first_name: {
                    required: "Please enter First name",
                },
                last_name: {
                    required: "Please enter Last name",
                },
                email: {
                    required: "Please enter valid email",
                },
                phone: {
                    validatePhone: "Please enter valid phone number",
                },
            },
                    highlight: function (element, errorClass) {
                $(element).removeClass(errorClass); //prevent class to be added to selects
            },
                    submitHandler: function (form,event) {
                // form.submit();
                        event.preventDefault();
                        var formData = new FormData(form);
                        var url = $('#contactEditForm').attr('action');
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
                                        window.location = "/members";
                                    });
                                } else {
                                    swal({
                                        title: "Error",
                                        text: data.message,
                                        type: "error"
                                    }).then(function () {
                                        window.location = "/members";
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
    }


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
@endsection
