<?php
/** @var \App\ModelsExtended\Member $member */
/** @var \App\ModelsExtended\MemberStatus[] $statuses */
?>
@extends('layouts.simple.master')

@section('title', 'Members')

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

        #exportCSVDropdownMenu {
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
            width: 100% !important;
            color: #fff;
        }

        #export-btn {
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
            width: 100% !important;
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
    <h3>Members</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Members</li>
@endsection

@section('content')
    <div class="container-fluid members-listing px-4">
        <div class="row second-chart-list third-news-update">
            <div class="xl-100 morning-sec box-col-12">
                <div class="card o-hidden">
                    <div class="card-body" style="min-height:500px">
                        <div class="mb-3 mb-sm-5 d-md-flex align-items-center justify-content-between member_filter_wrap">
                            <div class="controlbar">
                                <form name="searchForm" method="get" action="{{ url('/members') }}"
                                    onsubmit="return false;">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" class="form-control" id="searchInput"
                                        placeholder="Search a member (name, phone, email, etc.)" name="search"
                                        value="{{ request('search') }}" />
                                </form>
                            </div>
                            <div class="filter btn-group">
                                <span class="nav-link dropdown-toggle" role="button" id="filterDropdown">
                                    Filter:--
                                </span>
                                <div class="dropdown-menu p-4" id="filterDropdownMenu">
                                    <form id="filterFormCSV">
                                        <section class="mb-3">
                                            <p class="filterOptionLabel mb-2">Status</p>
                                            <div class="d-flex justify-content-between" id="statusFilterList">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input status_val"
                                                        name="status[]" value="active" data-val="1" id="active">
                                                    <label class="form-check-label" for="active">
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input status_val"
                                                        name="status[]" value="Interested party" data-val="3"
                                                        id="Interested-party">
                                                    <label class="form-check-label" for="Interested-party">
                                                        Interested party
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input status_val"
                                                        name="status[]" value="Archived" data-val="2" id="archived">
                                                    <label class="form-check-label" for="archived">
                                                        Archived
                                                    </label>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="mb-3">
                                            <p class="filterOptionLabel mb-2">Date Created</p>
                                            <div class="d-flex justify-content-between" id="createdDateFilterList">
                                               <input type="text" name="filterByDate" class="pull-left form-control" id="createdDateRange">
                                            </div>
                                        </section>
                                    </form>
                                    <div class="d-flex justify-content-between">
                                        <button id="clearBtn" onclick="clearAllFilterItem()" class="btn">Clear
                                            All</button>
                                        <button id="applyFilter" class="btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->role_id == App\ModelsExtended\Role::Super_Admin)
                            <div class="filter btn-group">
                                <a target="_self" role="button" id="exportCSVDropdown">
                                    <span>
                                        <img id="export-csv-btn-icon" src='{{ asset('assets/images/external-link.png') }}'>
                                    </span>
                                    EXPORT TO CSV
                                </a>
                                <div class="dropdown-menu p-4" id="exportCSVDropdownMenu">
                                    <form id="filterFormCSV">
                                        <section class="mb-3">
                                            <p class="filterOptionLabel mb-2">EXPORT MEMBERS</p>
                                            <div class="d-flex justify-content-between" id="statusCSVFilterList">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input status_val_csv"
                                                        name="status_csv[]" value="active" data-val="1" id="active-csv" checked>
                                                    <label class="form-check-label" for="active-csv">
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input status_val_csv"
                                                        name="status_csv[]" value="Interested party" data-val="3"
                                                        id="Interested-party-csv" checked>
                                                    <label class="form-check-label" for="Interested-party-csv">
                                                        Interested party
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input status_val_csv"
                                                        name="status_csv[]" value="Archived" data-val="2" id="Archived-csv" checked>
                                                    <label class="form-check-label" for="Archived-csv">
                                                        Archived
                                                    </label>
                                                </div>
                                            </div>
                                        </section>
                                    </form>
                                    <div class="d-flex justify-content-between">
                                        <button id="export-btn" data-href="/members-export-csv" class="btn" onclick ="exportMembers (event.target);">Export</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <a href="{{ route('members.add') }}" target="_self"
                                class="add-new-member-btn"><span>+</span>Add
                                new
                                Member</a>
                        </div>
                        <section id="filterListWrapper" style="display:none">
                            <div class="d-flex flex-md-row flex-column-reverse justify-content-end align-items-center">
                                <div class="p-2 w-100 text-end">
                                    <div class="filter_list_wrapper">
                                        <!-- <div class="filter_list" data-id='1'>
                                                                                                                                                                                        Active<span>X</span>
                                                                                                                                                                                    </div> -->
                                    </div>
                                </div>
                                <div class="p-2 flex-shrink-1" onclick="clearAllFilterItem()" id="clearAllFilters">Clear
                                    All
                                    Filters</div>
                            </div>
                        </section>
                        <div class="">
                            <table class="table table-striped table-bordered hover font-loto dt-responsive nowrap"
                                style="width:100%" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Zip Code</th>
                                        <th>Status</th>
                                        <th>Member Groups</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($members as $member)
                                        <tr>
                                            <td>{{ $member->first_name }}
                                                {{ $member->last_name }}</td>
                                            <td>{{ $member->phone }}
                                            </td>
                                            <td>{{ $member->email }}</td>
                                            <td>{{ $member->zipcode }}</td>
                                            <td>{{ $member->member_status->description }}</td>
                                            <th></th>
                                            <td>{{ $member->created_at }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="dropdown p-0 me-0">
                                                    <p class="mb-0 text-end" data-bs-toggle="dropdown"
                                                        aria-expanded="false"><i
                                                            style="color:#4D5997 !important;cursor:pointer"
                                                            data-feather="more-vertical"></i>
                                                    </p>
                                                    <ul class="dropdown-menu" style="color:#4D5997 !important">
                                                        <li><a href="{{ route('members.edit', $member->id) }}"
                                                                class="dropdown-item d-flex align-items-center font-loto"><i
                                                                    data-feather="user"></i><span
                                                                    class="ms-1 text-default">
                                                                    Edit </span></a></li>
                                                        <li><a href="#"
                                                                class="dropdown-item d-flex align-items-center font-loto"><i
                                                                    data-feather="message-square"></i><span
                                                                    class="ms-1 text-default">View Conversation</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
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

    <script>
        function exportMembers(_this) {
            let _url = $(_this).data('href');
            let status_val_list = [];
            $('#statusCSVFilterList input:checked').each(function(i) {
                status_val_list[i] = $(this).attr("data-val");
            });
            window.location.href = _url + '?status=' + status_val_list.join();
        }
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




        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#createdDateRange').val('');
            }

            $('#createdDateRange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            cb(start, end);

        });

        var filterItems = [];
        var memberTable;
        status_val = [];
        var table = '';
        $(document).ready(function() {
            table = $('#basic-1').DataTable({
                processing: true,
                serverSide: true,
                order: [6, 'desc'],
                paginate: true,
                pageLength: 25,
                ajax: {
                    url: "{{ route('members') }}",
                    data: function(d) {
                        d.datefilter = $('input[name="filterByDate"]').val();
                        $(':checkbox:checked').each(function(i) {
                            status_val[i] = $(this).attr("data-val");
                        });
                        d.status = status_val;
                        d.search_asset = $("#search_asset_tags").val()
                    }
                },
                columns: [{
                        data: 'first_name',
                        responsivePriority: 0,
                        name: 'first_name'
                    },
                    {
                        data: 'msisdn',
                        name: 'msisdn'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'zipcode',
                        name: 'zipcode'
                    },
                    {
                        data: 'member_status_id',
                        name: 'member_status_id'
                    },
                    {
                        data: 'contact_group',
                        name: 'contact_group',
                        orderable: false,
                        // searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        responsivePriority: 1,
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#searchInput').keyup(function() {
                table.search($(this).val()).draw();
            });
            $("#applyFilter").on("click", function() {
                table.ajax.reload();
            });

            $('#search_asset_tags').on("keyup", function() {
                if ($(this).val().length > 2) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('searchUsers') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            member: $(this).val(),
                        },
                        success: function(response) {
                            $('#members_list li').remove();
                            $('#members_list').append(response.html);
                        }
                    });
                } else {
                    $('#members_list li').remove();
                }
            });

            $("body").on("click", ".member_name", function() {
                $('#search_asset_tags').val($(this).html());
                filterItems.push($(this).html());
                $('#members_list li').remove();
            });



            $('body').on("click", ".status_change", function(event) {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                event.preventDefault();
                swal({
                        title: `Are you sure you want to change the status?`,
                        text: "",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((changeStatus) => {
                        if (changeStatus) {
                            $.ajax({
                                url: '{{ route('statusChange') }}',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    id: id,
                                    status: status
                                },
                                type: 'POST',
                                success: function(response) {
                                    if (response.status = "SUCCESS") {
                                        swal(response.message, '', 'success')
                                        table.ajax.reload(null, false);
                                    }
                                }
                            });
                        }
                    });
            });

            // console.log(lastSendAssetList)
            // lastSendAssetList.initialize();
            // $('#search_asset_tags').tagsinput({
            //     freeInput: false,
            //     typeaheadjs: {
            //         name: "lastSendAssetList",
            //         displayKey: "first_name",
            //         valueKey: 'first_name',
            //         source: lastSendAssetList.ttAdapter(),

            //     }
            // })


            $("#filterDropdown").click(function() {
                $("#filterDropdownMenu").toggle()
            });

            $("#exportCSVDropdown").click(function() {
                $("#exportCSVDropdownMenu").toggle()
            });

            $('#search_asset_tags').on('itemAdded', function(event) {
                // event.item: contains the item
                const index = filterItems.indexOf(event.item);
                if (index <= -1) { // only splice array when item is found
                    filterItems.push(event.item);
                }

            });
            $('#search_asset_tags').on('itemRemoved', function(event) {
                // event.item: contains the item
                const index = filterItems.indexOf(event.item);
                if (index > -1) { // only splice array when item is found
                    filterItems.splice(index, 1); // 2nd parameter means remove one item only
                }
            });

            $('#statusFilterList').on('change', 'input[type=checkbox]', function() {
                var id = $(this).val(); // this gives me null
                var index = filterItems.indexOf(id);

                if ($(this).is(':checked')) {
                    filterItems.push(id);
                } else {
                    if (index > -1) {
                        filterItems.splice(index, 1);
                    }
                }
            });

            $('#createdDateFilterList').on('change', 'input[name=filterByDate]', function() {
                var date = $(this).val(); // this gives me null
                if (date != '') {
                    filterItems.push(date);
                }
            });

            $('#applyFilter').click(function() {
                if (filterItems.length > 0) {
                    $('#filterListWrapper').show();
                    $('.filter_list_wrapper').empty();

                    filterItems.forEach((element) => {
                        var divId = element;
                        console.log(element);
                        if (element == 'Interested party') {
                            divId = 'Interested-party'
                        }

                        $(`<div class="filter_list" id="${divId}-selected">
                                        ${element}<span class="removeFilterItem" onclick="removeFilterItem('${element}')">X</span>
                                    </div>`).appendTo(".filter_list_wrapper");
                    });

                    $("#filterDropdown").text(`Filter: ${filterItems.length} applied`)
                } else {
                    $('#filterListWrapper').hide();
                    $("#filterDropdown").text(`Filter: ---`)
                }
                $("#filterDropdownMenu").toggle()
                // applyFilersOnDataTable(memberTable, filterItems)
            })
        });

        function clearAllFilterItem() {
            console.log("click on clearAllFilterItem")
            filterItems = [];
            $("#search_asset_tags").val();
            $("#filterDropdown").text(`Filter: ---`)
            $('#filterListWrapper').hide();
            $("#search_asset_tags").tagsinput('removeAll');
            $("#filterForm")[0].reset();
            status_val = [];
            table.ajax.reload();
            // applyFilersOnDataTable(memberTable, filterItems)
        }

        function removeFilterItem(id) {

            console.log("click on remove", id)
            var divId = id;
            if (id == 'Interested party') {
                divId = 'Interested-party'
            }

            const index = filterItems.indexOf(id);
            if (index > -1) { // only splice array when item is found
                filterItems.splice(index, 1); // 2nd parameter means remove one item only
            }

            $(`#${divId}-selected`).remove();
            $(`#${divId}`).prop("checked", false);
            console.log($(`#${divId}`));
            $("#search_asset_tags").tagsinput('remove', id);
            if (filterItems.length == 0) {
                $("#filterDropdown").text(`Filter: ---`)
                $('#filterListWrapper').hide();
            } else {
                $("#filterDropdown").text(`Filter: ${filterItems.length} applied`)
            }
            // applyFilersOnDataTable(memberTable, filterItems)
            table.ajax.reload()
        }

        {{--function applyFilersOnDataTable(dataTable, filterItems) {--}}
        {{--    var statusArr = [];--}}
        {{--    var datefilter = [];--}}
        {{--    filterItems.forEach((filterItem) => {--}}
        {{--        if (filterItem == 'active' || filterItem == 'Archived' || filterItem ==--}}
        {{--            'Interested party') {--}}
        {{--            statusArr.push(("^" + filterItem + "$"));--}}
        {{--        } else if (filterItem == 'ascending' || filterItem == 'descending') {--}}
        {{--            let query = 'ASC';--}}
        {{--            if (filterItem == 'descending') {--}}
        {{--                query = 'DESC';--}}
        {{--            } else {--}}
        {{--                query = 'ASC';--}}
        {{--            }--}}
        {{--            datefilter = query--}}
        {{--        }--}}
        {{--    });--}}

        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: "{{ route('members') }}",--}}
        {{--        data: {--}}
        {{--            datefilter: datefilter,--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            table.ajax.reload();--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection
