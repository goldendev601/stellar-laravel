<?php
/** @var \App\ModelsExtended\User $user */
?>
@extends('layouts.simple.master')

@section('title', 'Settings')

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
    <h3>Settings</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
    <div class="container-fluid members-listing px-4">
        <div class="row second-chart-list third-news-update">
            <div class="xl-100 morning-sec box-col-12">
                <div class="card o-hidden">
                    <div class="card-header card-no-border card-no-padding-bottom">
                        <div class="header-top">
                            <h5 class="m-0 text-default">Security</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-table table-responsive">
                            <table class="table table-bordernone">
                                <tbody>
                                    <tr>
                                        <form class="theme-form" action="{{ route('set-password') }}" method="POST" id="settingPasswordForm">
                                        @csrf
                                            <td class="profile-info-wrapper" >
                                                <h6 class="label-info-text">Password</h6>
                                                <p class="profile-info-text profile-name-info">**********************</p>
                                            </td>
                                            <td class="img-content-box edit-icon-wrapper">
                                                <span class="text-default edit-btn"><img class="edit-icon"
                                                    src="{{ asset('assets/images/edit-2.svg') }}"
                                                    alt="edit icon">Edit</span>
                                            </td>
                                            <td class="profile-form-wrapper" style="display: none;">
                                                <div>
                                                    <h6 class="label-info-text">Old Password</h6>
                                                    <input type="password" name="old_password" id="old_password" class="profile-form-input" placeholder="Enter old password">
                                                </div>
                                            </td>
                                            <td class="profile-form-wrapper" style="display: none;">
                                                <div>
                                                    <h6 class="label-info-text">New Password</h6>
                                                    <input type="password" name="password" id="password" class="profile-form-input" placeholder="Enter new password">
                                                </div>
                                                <div style="margin-left: 26px;">
                                                    <h6 class="label-info-text">Confirm new Password</h6>
                                                    <input type="password" name="password_confirmation" id="password_confirmation" class="profile-form-input" placeholder="Confirm new password">
                                                </div>
                                            </td>
                                            <td class="img-content-box btn-list-wrapper" style="display: none;">
                                                <span class="text-default cancel-btn">Cancel</span>
                                                <button class="save-btn">Save</button>
                                            </td>
                                        </form>
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
    </script>
@endsection
