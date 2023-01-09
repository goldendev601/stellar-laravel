<?php
/** @var \App\ModelsExtended\Member $member */
/** @var \App\ModelsExtended\MemberStatus[] $statuses */
?>
@extends('layouts.simple.master')

@section('title', 'Administrators')

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">

    <!-- dataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/members.css') }}">


@endsection

@section('style')
    <style>
        .dropdown .dropdown-menu {
            background: #FFFFFF;
            /* Regular Shadow */

            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }

        .dropdown .dropdown-menu .dropdown-item {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 21px;
            color: #4D5997 !important;
            opacity: 1 !important;
        }

        .dropdown .dropdown-menu .dropdown-item i {
            color: #4D5997 !important;
        }

        /* member list page filter css */

        #filterDropdownMenu {
            width: 458px;
            min-width: 300px;
            left: -365px;
            border-radius: 15px;
        }

        .searchAsset .bootstrap-tagsinput {
            width: 100%;
            border-radius: 0;
            height: 45px;
            padding-left: 2.375rem;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            box-shadow: none !important;
        }

        .searchAsset .bootstrap-tagsinput input {
            width: 200px !important;
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 30px;
            color: #000000;
        }

        .searchAsset .bootstrap-tagsinput .tag {
            font-size: 14px;
            padding: 5px;
            font-family: "Lato";
            font-style: normal;
        }

        .searchAsset .bootstrap-tagsinput .label-info {
            background: transparent !important;
            border-radius: 15px !important;
            color: #4d5997 !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        .searchAsset .bootstrap-tagsinput .tag [data-role="remove"]:after {
            content: "x";
            padding: 0px 2px;
            color: #958e8e !important;
            font-weight: 600;
            font-size: 16px;
        }

        .searchAsset .form-control {
            padding-left: 2.375rem;
        }

        .searchAsset .form-control-feedback {
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

        .searchAsset span.twitter-typeahead .tt-menu {
            width: 300px !important;
        }

        .searchAsset span.twitter-typeahead .tt-suggestion {
            color: #4d5997 !important;
            opacity: 1 !important;
            font-size: 13px;
            padding: 6px 12px;
            border-top: 1px solid #efefef !important;
            background: #fff !important;
            cursor: pointer;
        }

        #filterDropdown {
            font-family: 'SF Pro Text';
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            line-height: 22px;
            letter-spacing: -0.408px;
            color: #4D5997;
            text-transform: uppercase;
        }

        .filterOptionLabel {
            font-family: "SF Pro Text";
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 20px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #333333;
        }

        #filterForm label {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 14px;
            color: #313133;
        }

        #clearBtn {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 21px;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            padding: 8px 16px;
            background: transparent;
            border: 1px solid #4D5997;
            border-radius: 8px;
            width: 40% !important;
            color: #4D5997;
        }

        #applyFilter {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 21px;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            padding: 8px 16px;
            background: #4D5997;
            border-radius: 8px;
            width: 40% !important;
            color: #fff;
        }


        #clearAllFilters {
            width: 9%;
            text-align: end;
            font-family: "SF Pro Text";
            font-style: normal;
            font-weight: 700;
            font-size: 12px;
            line-height: 22px;
            letter-spacing: -0.408px;
            color: #4d5997;
            cursor: pointer;
        }

        .filter_list_wrapper {}

        .filter_list_wrapper .filter_list {
            display: inline-block;
            vertical-align: top;
            background: #f7f7f7;
            border-radius: 30px;
            margin: 5px;
            padding: 10px 25px 10px 10px;
            position: relative;
            color: #4d5997;
            font-family: "Lato";
            font-style: normal;
            font-weight: 700;
            font-size: 12px;
            line-height: 21px;
        }

        .filter_list_wrapper .filter_list.filter_list_hide {
            display: none;
        }

        .filter_list_wrapper .filter_list span {
            position: absolute;
            right: 8px;
            top: 10px;
            cursor: pointer;
        }

        .removeFilterItem {
            color: #958e8e !important;
            font-weight: 600;
            font-size: 16px;
        }

        #basic-1_filter {
            display: none;
        }
        .range_inputs{
            display: flex;
            flex-direction: row-reverse;
            flex-wrap: wrap;
            gap: 5px;
        }

        element.style {
        }
        button.applyBtn.btn.btn-sm.btn-success {
            width: 75px;
            padding: 5px 0px;
            border-radius: 4px;
            background: #4D5997 !important;
            border: 1px solid #4D5997 !important;
        }
        button.cancelBtn.btn.btn-sm.btn-default {
            width: 75px;
            padding: 0px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }
        @media only screen and (min-device-width: 320px) and (max-device-width: 812px) and (-webkit-min-device-pixel-ratio: 3) {
            #filterDropdownMenu {
                width: 330px;
                min-width: 300px;
                left: -14px;
                border-radius: 15px;
                box-shadow: 0 0 20px rgb(77 89 151 / 25%);
            }

            .members-listing #searchInput:placeholder-shown {
                color: red !important;
                max-width: 95% !important;
                text-overflow: ellipsis;
                overflow: hidden !important;
            }

            #clearAllFilters {
                width: 42%;
            }
        }
    </style>
@endsection
@section('breadcrumb-title')
    <h3>Administrators</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Administrators</li>
@endsection

@section('content')
    <div class="container-fluid members-listing px-4">
        <div class="row second-chart-list third-news-update">
            <div class="xl-100 morning-sec box-col-12">
                <div class="card o-hidden">
                    <div class="card-body" style="min-height:500px">
                        <div class="">
                            <table class="table table-striped table-bordered hover font-loto dt-responsive nowrap"
                                style="width:100%" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->first_name }}
                                                {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->description }}</td>
                                            <td>{{ $user->status->description }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown p-0 me-0">
                                                    <p class="mb-0 text-end" data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i
                                                            style="color:#4D5997 !important;cursor:pointer"
                                                            data-feather="more-vertical"></i>
                                                    </p>
                                                    <ul class="dropdown-menu" style="color:#4D5997 !important">
                                                        <li>
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="dropdown-item d-flex align-items-center font-loto"><span
                                                                    class="ms-1 text-default">
                                                                    Edit </span>
                                                            </a>
                                                        </li>
                                                       
                                                    </ul>
                                                </div>
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
    </div>
    <script type="text/javascript">
        var session_layout =
            '{{ session()->get('
                                                                                                                                                                                                                                                                                                                                                                                                                layout ') }}';
    </script>
@endsection

@section('script')
    <script>
        setTimeout(function() {
            $('#success-meg').fadeOut('fast');
        }, 4000);
    </script>


    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>

    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>

    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>



    <script>
        @if ($message = session('success'))
            swal("{!! session()->get('success') !!}");
        @endif
    </script>
    <script>
    </script>
@endsection
