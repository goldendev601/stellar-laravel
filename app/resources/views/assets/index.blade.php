@extends('layouts.simple.master')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection

@section('style')
    <style>
        .loader-box .loader-15 {
            width: 1em !important;
            height: 2em !important;
            margin: 0 0.5em !important;
        }

        .loader-box .loader-15:before {
            right: 1.5em !important;
        }

        .loader-box .loader-15:after {
            left: 1.5em !important;
        }

        .assetActive #assetName {
            font-weight: 700;
            font-size: 14px;
            line-height: 17px;
            color: #FFFFFF;
        }

        .assetActive #assetType {
            font-weight: 600;
            font-size: 12px;
            line-height: 12px;
            color: #FFFFFF;
            opacity: 0.5;
            text-transform: uppercase;
        }

        .assetActive #assetAddress {
            font-weight: 400;
            font-size: 12px;
            line-height: 14px;
            color: #FFFFFF;
        }

        .assetActive #assetDateTime {
            font-weight: 400;
            font-size: 12px;
            line-height: 14px;
            color: #FFFFFF;
        }

        .assetActive #assetPrice {
            font-weight: 700;
            font-size: 14px;
            line-height: 17px;
            color: #FFFFFF !important;
        }

        .assetActive #assePartySize {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 16px;
            color: #FFFFFF;
        }

        /*  for inactive assets */
        .assetInActive {
            background: #F5F7FD !important;
            border-radius: 14px !important;
            box-shadow: none !important;
        }

        .assetInActive #assetType {
            font-weight: 600;
            font-size: 12px;
            line-height: 12px;
            color: #000000;
            opacity: 0.5;
            text-transform: uppercase;
        }

        .assetInActive #assetName {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            line-height: 17px;
            color: #000000;
        }

        .assetInActive #assetAddress {
            font-weight: 400;
            font-size: 12px;
            line-height: 14px;
            color: #000000;
        }

        .assetInActive #assetDateTime {
            font-weight: 400;
            font-size: 12px;
            line-height: 14px;
            color: #000000;
        }

        .assetInActive #assetPrice {
            font-weight: 700;
            font-size: 14px;
            line-height: 17px;
            text-align: right;
            color: #000000;
        }

        .assetInActive #assePartySize {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 16px;
            color: #000000;
        }
        .asset_count_div.mt-4 {
            color: #4d5997;
            margin-left: 10px;
        }
        div#assets_list_container {
            height: 472px;
            overflow-y: auto;
        }
        /* width */
        div#assets_list_container::-webkit-scrollbar  {
            width: 1px;
        }

        /* Track */
        div#assets_list_container::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px transparent;
            border-radius: 10px;
        }

        /* Handle */
        div#assets_list_container::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 10px;
        }
        div#assetsPageRight {
            height: 555px;
            overflow-y: auto;
        }

        div#assetsPageRight::-webkit-scrollbar  {
            width: 1px;
        }

        /* Track */
        div#assetsPageRight::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px transparent;
            border-radius: 10px;
        }

        /* Handle */
        div#assetsPageRight::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 10px;
        }

        @media screen and (min-width: 1280px) and (max-width: 1400px) {
            .asset-detail-card-header {
                display: block !important;
            }
            #assetPrice { 
                text-align: left !important;
            }
            #assePartySize {
                font-size: 9px !important;
            }
            #assetDateTime {
                font-size: 9px !important;
            }
            #assetAddress {
                font-size: 11px !important;
            }
        }

        @media screen and (min-width: 1024px) and (max-width: 1279px) {
            .asset-detail-card-header {
                display: block !important;
            }
            #assetPrice { 
                text-align: left !important;
            }
            #assePartySize {
                font-size: 9px !important;
            }
            #assetDateTime {
                font-size: 9px !important;
            }
            #assetAddress {
                font-size: 11px !important;
            }
        }

        @media screen and (min-width: 800px) and (max-width: 1023px) {
            .asset-detail-card-header {
                display: block !important;
            }
            #assetPrice { 
                text-align: left !important;
            }
            #assePartySize {
                font-size: 9px !important;
            }
            #assetDateTime {
                font-size: 9px !important;
            }
            #assetAddress {
                font-size: 11px !important;
            }
        }

        @media screen and (max-width: 799px) {
            .asset-detail-card-header {
                display: block !important;
            }
            #assetPrice { 
                text-align: left !important;
            }
            #assePartySize {
                font-size: 9px !important;
            }
            #assetDateTime {
                font-size: 9px !important;
            }
            #assetAddress {
                font-size: 11px !important;
            }
        }

    </style>
@endsection

@section('breadcrumb-title')
    <h3>Assets</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Assets</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between pb-3">
                    <h1>Assets</h1>
                    <a href="{{ route('create_asset') }}" target="_self" class="add-new-asset-btn"><span>+</span>Add new
                        Asset</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="xl-100 box-col-12">
                <div class="card o-hidden">
                    <div class="card-body p-0">
                        <div class="row p-3 mt-2">
                            <div class="col-md-3 border-end " id="assest_list_main">
                                <div id="search_assets_form">
                                    <form name="searchForm"  method="get" action="{{ url('/assets/index') }}">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <input class="search-input-field" type="text" placeholder="Search" name="search"
                                                   value="{{ request('search') }}"
                                                   onkeyup="submitFormOnEnter(document.searchForm, event)"/>

                                            {{--                                        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
                                            {{--                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
                                            {{--                                            <path stroke-linecap="round" stroke-linejoin="round"--}}
                                            {{--                                                  d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/>--}}
                                            {{--                                        </svg>--}}
                                        </div>
                                    </form>
                                </div>
                                <div class="asset_count_div mt-4">
                                   <span class="asset_conut">{{ count($assets) }}</span> assets
                                </div>
                                <div id="assets_list_container">
                                @if (count($assets)>0)
                                    @foreach ($assets as $key => $asset)
                                        <div id="{{ $asset->id }}" class="card asset o-hidden mt-2  mt-4 assetInActive">
                                            <div class="card-body cp p-4">
                                                <div class="d-flex align-items-center justify-content-between asset-detail-card-header">
                                                    <span class="font-loto"
                                                        id="assetType">{{$asset->asset_category['description']}}</span>
                                                                <p class="font-loto" id="assetPrice">
                                                                    {{$asset->asset_cost['cost_details']}}</p>
                                                            </div>
                                                            <h3 class="font-loto pt-3" id="assetName">
                                                                {{ $asset->name }}
                                                            </h3>
                                                            <div class="d-flex align-items-center pt-2">
                                                    <span class="d-flex align-items-center">
                                                        <svg class="user-icon" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                                                clip-rule="evenodd"/>
                                                        </svg>
                                                        @if($asset->asset_category['id'] ==
                                                        App\ModelsExtended\AssetCategory::Accommodation)
                                                            <span class="pl-3" id="assePartySize">
                                                            {{$asset->asset_accommodation_info['number_of_guest'] ? $asset->asset_accommodation_info['number_of_guest']:0}}</span>
                                                        @elseif($asset->asset_category['id'] ==
                                                        App\ModelsExtended\AssetCategory::Dining)
                                                            <span class="pl-3" id="assePartySize">
                                                            {{$asset->asset_dining_info['number_of_guest'] ? $asset->asset_dining_info['number_of_guest']: 0}}</span>
                                                        @elseif($asset->asset_category['id'] ==
                                                        App\ModelsExtended\AssetCategory::Event)
                                                            <span class="pl-3" id="assePartySize">
                                                            {{$asset->asset_event_info['number_of_seats'] ? $asset->asset_event_info['number_of_seats'] :0}}</span>
                                                        @elseif($asset->asset_category['id'] ==
                                                        App\ModelsExtended\AssetCategory::Miscellaneous)
                                                            <span class="pl-3" id="assePartySize">
                                                            {{$asset->asset_miscellaneous_info['number_of_seats'] ? $asset->asset_miscellaneous_info['number_of_seats']:0}}</span>
                                                        @endif
                                                    </span>
                                                    <span class="px-2">|</span>
                                                    <p class="font-loto" id="assetDateTime">
                                                        {{ convertDateForAsset($asset->check_in_datetime) }}</p>
                                                </div>
                                                <h5 class="pt-2 font-loto"
                                                    id="assetAddress">{{ $asset->venue_address }}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h4 class="mt-4">No Assets Found!!</h4>
                                @endif
                                </div>
                            </div>
                            <div id="assetsPageRight" class="col-md-9 py-3 px-5">
                                <div class="loaderWrapper">
                                    <div class="loader-box" style="height:250px !important">
                                        <div class="loader-15"></div>
                                    </div>
                                </div>
                                <div id="selected"></div>
                            </div>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script>
        function submitFormOnEnter(form, event) {
            if (event.keyCode === 13) form.submit();
        }

        $(document).ready(function () {
            var id = {!! json_encode(request()->route('id')) !!};
            var firstID = (id != null) ? id : $(".asset:first").attr("id")
            if (firstID) {
                $("#"+firstID).addClass("bg-theme-primary text-white assetActive").removeClass("assetInActive");
                $("#"+firstID).prependTo("#assets_list_container");
                $("div.asset").slice(1).addClass("text-black");
                $.ajax({
                    url: "/assets/show/" + firstID,
                    method: "GET",
                    beforeSend: function () {
                        $("#assetsPageRight .loaderWrapper").show();
                    },
                    success: function (data) {
                        $("#assetsPageRight #selected").html(data);
                    },
                    complete: function () {
                        $("#assetsPageRight .loaderWrapper").hide();
                        $("#assetsPageRight #selected").show();
                    },
                });
            }

            $(document).on('click', '.shareBtn', function () {
                let assetId = $(this).attr('asset')
                $.ajax({
                    url: "/assets/receivedAssetList/" + assetId,
                    method: "GET",
                    success: function (data) {
                        let html = '';
                        $('.receivedAsset').html(data.assetReceiverList.length)
                        $('.assetMemberList').html('');
                        let assetCategory = (data.asset.asset_category) ? data.asset.asset_category.description : '';
                        let assetName = data.asset.name;
                        let assetDescription = data.asset.description;
                        let assetCheckInDatetime = data.asset.checkInDatetime;
                        let assetVenueAddress = data.asset.venue_address;
                        $.each(data.assetReceiverList, function (index, value) {
                            let memberImage = (value.member.image_url) ? value.member.image_url : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png';
                            html += `<div class="listItem">
                                <div>
                                    <img src="${memberImage}" width="38px" height="38px">
                                </div>
                                <div>
                                    <span>${value.member.first_name} ${value.member.last_name}</span>
                                </div>
                         </div>`;

                        });

                        $('#asset_id').val(assetId);
                        $('.assetMemberList').html(html);
                        $('#assetReceiverModal').modal('show');
                        $('.assetCategory').html(assetCategory);
                        $('.assetName').html(assetName);
                        $('.assetDescription').html(assetDescription);
                        $('.checkInDatetime').html(assetCheckInDatetime);
                        $('.assetVenueAddress').html(assetVenueAddress);
                        $('#share_asset_message').val(data.message);
                        let members = '';
                        $.each(data.memberWithoutAsset, function (index, value) {
                            members += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#member_ids').html(members);

                        let groups = '';
                        $.each(data.memberGroupList, function (index, value) {
                            groups += `<option value="${value.id}">${value.name}</option>`;
                        });
                        $('#group_ids').html(groups);
                    }
                });

            });
            $(document).on('click', '.checkShare', function () {
                if ($("#members").is(":checked")) {
                    $('.member_list').removeClass('d-none');
                    $('.group_list').addClass('d-none');
                    $('#group_ids').val(null).trigger('change');
                    $("#group_ids").val('').trigger('change');
                    $('.error_members').html('');
                } else {
                    $('.member_list').addClass('d-none');
                    $('.group_list').removeClass('d-none');
                    $('#member_ids').val(null).trigger('change');
                    $("#member_ids").val('').trigger('change');
                    $('.error_groups').html('');
                }
            })
            $(document).on('click', '.addMorePeople', function () {
                $('#shareAssetModal').modal('show');
                $('#group_ids').val(null).trigger('change');
                $('#member_ids').val(null).trigger('change');
                $('#members').prop('checked', true);
                $('#members').click();
                $('#assetReceiverModal').modal('hide');

            });

            $(document).on('click','.sendAsset',function (event){
                event.preventDefault();
                let validateForm = true;
                if ($("#members").is(":checked")) {
                    if($("#member_ids").val() == ''){
                        $('.error_members').html('Please select member');
                        validateForm = false;
                    }
                }else{
                    if($("#group_ids").val() == ''){
                        $('.error_groups').html('Please select group');
                        validateForm = false;
                    }
                }
                if(validateForm){
                    $.ajax({
                      url: $('#assetShareForm').attr('action'),
                      type:'POST',
                      data : $('#assetShareForm').serialize(),
                      success : function (data){

                        if(data.response == 'success'){
                            swal({
                                title: "Asset share.",
                                text: data.message,
                                icon: "success",
                            }).then(() => {
                                $('#shareAssetModal').modal('hide');
                                $('#'+data.asset_id).click();
                            })

                        }else{
                            swal({
                                title: "Something went wrong.",
                                text: data.message,
                                icon: "error",
                            }).then(() => {
                                $('#shareAssetModal').modal('hide');
                                $('#'+data.asset_id).click();

                            })

                        }
                      },
                      error : function (response){

                      }
                    });
                }
            });

            $(".asset").click(function () {
                $("#assetsPageRight #selected").hide();
                $("#selected .loaderWrapper").show();
                var id = $(this).attr("id");
                $("div.asset")
                    .removeClass("bg-theme-primary text-white assetActive")
                    .addClass("text-black assetInActive");

                $(this).removeClass("text-black assetInActive");
                $(this).addClass("bg-theme-primary text-white assetActive");
                $.ajax({
                    url: "/assets/show/" + id,
                    method: "GET",
                    beforeSend: function () {
                        $("#assetsPageRight .loaderWrapper").show();
                    },
                    success: function (data) {
                        console.log(data)
                        $("#assetsPageRight #selected").html(data);
                    },
                    complete: function () {
                        $("#assetsPageRight .loaderWrapper").hide();
                        $("#assetsPageRight #selected").show();
                    },
                });
            });
        });
    </script>
@endsection
