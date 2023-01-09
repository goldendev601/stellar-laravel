@extends('layouts.simple.master')

@section('title', 'Edit User')

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
<h3>Users</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item "><a href="{{ route('users')}}">Users</a></li>
<li class="breadcrumb-item active">Edit User</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="xl-100 morning-sec box-col-12">
            <div class="card o-hidden">
                <div class="card-body">
                    <form method="post" id="contactEditForm" action="{{ route('users.update', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 d-flex justify-content-between">
                                <h6 class="f-w-700">EDIT USER</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro"> NAME: *</label>
                                <input class="form-control" type="text" value="{{ $user->name }}"   data-bs-original-title="" title="" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro"> Email: *</label>
                                <input class="form-control" type="text" value="{{ $user->email }}"   data-bs-original-title="" title="" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">ROLE: *</label>
                                <select class="form-control form-select f-sf-pro" name="role_id" required>
                                    @foreach ($roles as $role)
                                            <option
                                                value="{{ $role->id }}" @if ($user->role_id == $role->id)
                                                {{ 'selected' }}
                                                @endif>
                                        {{ $role->description }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('is_active'))
                                <span class="text-danger f-sf-pro">{{ $errors->first('is_active') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="form-label f-sf-pro">STATUS: *</label>
                                <select class="form-control form-select f-sf-pro" name="status_id" required>
                                    @foreach ($statusList as $status)
                                            <option
                                                value="{{ $status->id }}" @if ($user->status_id == $status->id)
                                                {{ 'selected' }}
                                                @endif>
                                        {{ $status->description }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('is_active'))
                                <span class="text-danger f-sf-pro">{{ $errors->first('is_active') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end ">
                                <a href="{{ route('users')}}" class="btn mt-4 addContactCancelBtn">Cancel</a>
                                <button class="btn btn-primary mt-4 addContactBtn" type="submit">Update
                                        User
                                    </button>
                            </div>
                        </div>
                    </form>
                </div>
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

<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

<script src='https://foliotek.github.io/Croppie/croppie.js'></script>

<script>
    $(document).ready(function () {
        if ($("#contactEditForm").length > 0) {
            // Suppose that your method is well defined

            $("#contactEditForm").validate({
                rules: {
                    first_name: {
                        required: true,
                        maxlength: 250
                    },
                },
                messages: {
                    first_name: {
                        required: "Please enter First name",
                    },
                },
                    highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass); //prevent class to be added to selects
                },
                    submitHandler: function (form) {
                    form.submit();
                }
            })
        }

    });
</script>
@endsection
