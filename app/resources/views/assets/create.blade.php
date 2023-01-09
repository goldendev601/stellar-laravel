<?php /** @var \App\ModelsExtended\Vendor[]|\Illuminate\Database\Eloquent\Collection $venues * */ ?>
<?php /** @var \App\ModelsExtended\Member[]|\Illuminate\Database\Eloquent\Collection $sellers * */ ?>
@extends('layouts.simple.master')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('title]', 'Assets Create')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/assets.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/jquery.fancybox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/dropzone.css')}}">
@endsection

@section('style')

    <style>
        .selection .select2-selection {
            border-radius: 0px !important;
        }

        .select2-container .select2-selection--single {
            height: 45px !important;
        }

        .select2-container--open .select2-dropdown {
            z-index: 100;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 0px;
        }

        .select2-container--default .select2-results__options .select2-results__option[aria-selected=true] {
            color: #4D5997 !important;
            background: #FFFFFF !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            color: #4D5997 !important;
            background: #FFFFFF !important;
        }


        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-family: 'Lato' !important;
            font-style: normal !important;
            font-weight: 400 !important;
            font-size: 16px !important;
            line-height: 33px !important;
            color: #000000 !important;
        }

        .select2-dropdown {
            background-color: white;
            border: none !important;
            box-shadow: 0px 8px 16px rgb(0 0 0 / 15%);
            border-radius: 10px;
        }

        .select2-results__option {
            font-family: 'Lato' !important;
            font-style: normal !important;
            font-weight: 500 !important;
            font-size: 14px !important;
            line-height: 21px !important;
            color: #4D5997 !important;
            padding: 8px 16px !important;
            background: #FFFFFF !important;
        }

        .select2-search__field:focus {
            outline-color: #aaa;
            outline-offset: -1px !important;
        }

        .disabled {
            background: #4d59978c;
            cursor: none;
        }

        #venueNameInputField .venue_name_n {
            z-index: 7 !important;
        }

        div#venueNameDropdown {
            z-index: 7 !important;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Assets</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item "><a href="{{ route('assets_index')}}">Assets</a></li>
    @if($asset->id)
        <li class="breadcrumb-item active">Edit Asset</li>
    @else
        <li class="breadcrumb-item active">Add New Asset</li>
    @endif

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between pb-3">
                    @if($asset->id != null)
                        <h3 class="fw-bold">Edit asset</h3>
                        <div class="d-flex justify-content-between ">
                            <a href="{{route('assets_preview',['category'=> $asset->asset_category['description'],'id'=>$asset->id])}}"
                               class="preview-assets-btn font-loto fw-600 me-2" target="_blank">
                                Preview asset</a>
                            <a href="javascript:void(0)" class="add-new-asset-btn font-loto fw-600 add-asset">
                                Update</a>
                        </div>
                    @else
                        <h3 class="fw-bold font-loto">Create asset</h3>
                        <div class="d-flex justify-content-between ">

                            <a href="javascript:void(0)" class="add-new-asset-btn font-loto fw-600 add-asset"
                               data-form="accommodation">
                                Save and publish</a>

                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row nav">
            <div class="xl-100 box-col-12">
                <div class="card o-hidden">
                    <div class="card-body">
                        <div>
                            <p class="font-sf-pro typeLabel">TYPE</p>
                            <div class="btn-group container-fluid p-0">
                                @if($asset->id != null)
                                    <button type="button" class="nav-link btn border py-3 rounded text-capitalize font-loto fs-6 category btn-primary active-category active
                                " data-bs-toggle="tab"
                                            data-bs-target=".{{strtolower($asset->asset_category['description'])}}"
                                            role="tab"
                                            aria-controls="{{$asset->asset_category['description']}}"
                                            aria-selected="true"
                                            id="active-category"
                                            data-id="{{$asset->asset_category_id}}">{{$asset->asset_category['description']}}</button>

                                @else
                                    <button type="button"
                                            class="nav-link btn border py-3 rounded text-capitalize font-loto fs-6 category btn-primary active-category active"
                                            data-bs-toggle="tab" data-bs-target=".accommodation" role="tab"
                                            aria-controls="Accommodation" aria-selected="true" id="active-category"
                                            data-id="{{ App\ModelsExtended\AssetCategory::Accommodation }}">
                                        Accommodation
                                    </button>
                                    <button type="button"
                                            class="nav-link btn border py-3 rounded text-capitalize font-loto fs-6 category"
                                            data-bs-toggle="tab" data-bs-target=".dining" role="tab"
                                            aria-controls="Dining"
                                            aria-selected="false"
                                            data-id="{{ App\ModelsExtended\AssetCategory::Dining }}">Dining
                                    </button>
                                    <button type="button"
                                            class="nav-link btn border py-3 rounded text-capitalize  font-loto fs-6 category"
                                            data-bs-toggle="tab" data-bs-target=".event" role="tab"
                                            aria-controls="Event"
                                            aria-selected="false"
                                            data-id="{{ App\ModelsExtended\AssetCategory::Event }}">Event
                                    </button>
                                    <button type="button"
                                            class="nav-link btn border py-3 rounded text-capitalize font-loto fs-6 category "
                                            data-bs-toggle="tab" data-bs-target=".misc" role="tab"
                                            aria-controls="Miscellaneous"
                                            aria-selected="false"
                                            data-id="{{ App\ModelsExtended\AssetCategory::Miscellaneous }}">
                                        Miscellaneous
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="tab-content">
                            <div
                                class="accommodation tab-pane fade @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Accommodation) active show @elseif($asset->id == null) active show @endif"
                                role="tabpanel" aria-labelledby="nav-home-tab">
                                <form method="post" id="asset-form" enctype="multipart/form-data">
                                    <input type="hidden" name="category_id" class="form-control font-loto"
                                           value="{{ App\ModelsExtended\AssetCategory::Accommodation }}">
                                    <div class="row">
                                        <div class="col-sm-12 validationNeed">
                                            <label for="name" class="mt-4 required font-sf-pro">ASSET NAME</label><i
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-original-title="The name of the asset displayed as a listing"
                                                class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <input type="text" name="name" class="form-control font-loto"
                                                   value="{{$asset->name}}" placeholder="Enter asset name" id="name">
                                            <input type="hidden" name="id" value="{{$asset->id}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 validationNeed">
                                            <label for="venue" class="mt-4 required font-sf-pro">VENUE NAME
                                            </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       data-bs-original-title="The name of the site or venue that is hosting the experience"
                                                       class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <div id="venueNameInputField">
                                                <i class="fa fa-search prependIcon">
                                                </i>
                                                <div class="dropdown venue_name_n w-100">
                                                    <input type="text" name="venue"
                                                           class="form-control font-loto venue_name_accommodation"
                                                           placeholder="Search venue" value="{{$asset->venue_name}}"
                                                           autocomplete="off" id="venue_name">
                                                    <div
                                                        class="dropdown-menu venueNameDropdown venueNameDropdownAccommodation"
                                                        id="venueNameDropdown">
                                                        <i class="hasNoResults">No matching results</i>
                                                        <div class="list-autocomplete">
                                                            @foreach($venues as $venue )
                                                                <button type="button" class="dropdown-item"
                                                                        timezone="{{ $venue->timezone_id }}"
                                                                        data-images="{{ $venue->images }}"
                                                                        address-value="{{$venue->address}}" alias="{{$venue->alias}}">{{ $venue->name}}</button>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="address" class="mt-4 required font-sf-pro">VENUE
                                                ADDRESS</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                  data-bs-original-title="The full address of the location/venue"
                                                                  class="fa fa-info-circle ms-1" aria-hidden="true"></i>

                                            <div id="venue-address-suggestions">
                                                <i class="fa fa-map-marker prependIcon">
                                                </i>
                                                <input type="text" name="address"
                                                       class="venueAddAutosuggest form-control font-loto venueAddAutosuggestAccommodation"
                                                       placeholder="Enter venue address" id="address"
                                                       value="{{$asset->venue_address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 validationNeed">
                                            <label for="seller" class="mt-4 required font-sf-pro">SELLER</label>
                                            <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                               data-bs-original-title="The name of the seller. If seller is not shown on the dropdown  options, you may add one."
                                               class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <select class="form-control sellerSelect font-loto" name="seller"
                                                    id="sellerSelect">
                                                <option></option>
                                                @foreach($sellers as $seller)
                                                    <option value="{{$seller->id}}"
                                                        {{$asset->seller_id == $seller->id  ? 'selected' : ''}}>
                                                        {{$seller->first_name}} {{$seller->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="status" class="mt-4 required font-sf-pro">STATUS</label><i
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-original-title="The availability of the asset"
                                                class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <select class="form-control form-select font-loto" id="status"
                                                    name="status">
                                                @foreach($statuses as $status)
                                                    <option value="{{$status->id}}"
                                                        {{$asset->asset_status_id == $status->id  ? 'selected' : ''}}>
                                                        {{$status->description}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="date" class="mt-4 required font-sf-pro">COST DETAILS</label><i
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-original-title="The check in and check out date"
                                                class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <input name="cost_details" class="form-control font-loto" type="text"
                                                   placeholder="Enter details" name="costDetails"
                                                   value="{{@$asset->asset_cost['cost_details']}}">
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="date" class="mt-4 required font-sf-pro">Date of check
                                                in
                                            </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       data-bs-original-title="The date and time of asset reservation"
                                                       class="fa fa-info-circle ms-1" aria-hidden="true"></i>

                                            <div class="btn-group w-100">
                                                <div id="accommodationDateCheckin" class="w-100">
                                                    <i class="fa fa-calendar-o prependIcon">
                                                    </i>
                                                    <input type="text" name="check_in_datetime"
                                                           class="form-control font-loto"
                                                           id="accommodationDateCheckinield"
                                                           value="{{convertDateWithMonthNameDayYear(@$asset->check_in_datetime)}}">
                                                    <span class="text-danger mt-2 error_check_in_datetime"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="date" class="mt-4 required font-sf-pro">Date of check
                                                out
                                            </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       data-bs-original-title="The date and time of asset check out "
                                                       class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <div class="btn-group w-100">
                                                <div id="accommodationDateCheckout" class="w-100">
                                                    <i class="fa fa-calendar-o prependIcon">
                                                    </i>
                                                    <input type="text" class="form-control font-loto"
                                                           name="check_out_date"
                                                           id="accommodationDateCheckoutField"
                                                           value="{{convertDateWithMonthNameDayYear(@$asset->check_out_date)}}">
                                                    <span class="text-danger mt-2 error_check_out_date"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <div>
                                                <label for="date" class="mt-4 required font-sf-pro">Date and time of
                                                    deadline</label><i data-bs-toggle="tooltip"
                                                                       data-bs-placement="bottom"
                                                                       data-bs-original-title="The date and time of deadline of asset reservation"
                                                                       class="fa fa-info-circle ms-1"
                                                                       aria-hidden="true"></i>
                                            </div>
                                            <div class="btn-group w-100">
                                                <div id="accommodationDeadlineDate" class="w-50">
                                                    <i class="fa fa-calendar-o prependIcon">
                                                    </i>
                                                    <input type="text" name="deadline_date"
                                                           class="form-control font-loto"
                                                           id="accommodationDeadlineDateField"
                                                           value="{{convertDateWithMonthNameDayYear(@$asset->deadline_datetime)}}">
                                                </div>
                                                <div id="accommodationDeadlineTime" class="w-50">
                                                    <i class="fa fa-clock-o prependIcon">
                                                    </i>
                                                    <input type="text" name="deadline_time"
                                                           class="form-control font-loto datetimepicker-input"
                                                           id="accommodationDeadlineTimeField" placeholder="9:40 AM"
                                                           data-toggle="datetimepicker"
                                                           data-target="#accommodationDeadlineTimeField"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="timezone" class="mt-4 font-sf-pro validationNeed required">EVENT
                                                TIMEZONE</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                   data-bs-original-title="The timezone of the event"
                                                                   class="fa fa-info-circle ms-1"
                                                                   aria-hidden="true"></i>
                                            <select class="form-control form-select  font-loto" name="timezone"
                                                    id="event_timezone">
                                                <option value="">Select timezone</option>
                                                @foreach($timezones as $timezone)
                                                    <option value="{{$timezone->id}}"
                                                        {{@$asset->timezone_id == $timezone->id  ? 'selected' : ''}}
                                                    @if(!@$asset->timezone_id)
                                                        {{ \App\ModelsExtended\Timezone::EST == $timezone->id  ? 'selected' : ''}}
                                                        @endif>
                                                        {{$timezone->description}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-sm-6 validationNeed">
                                            <label for="no_of_guests" class="mt-4 required font-sf-pro">NUMBER OF
                                                GUESTS</label><i
                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                data-bs-original-title="The number of guests checking into the venue"
                                                class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                            <input type="number" name="number_of_guest" id="number_of_guest"
                                                   class="form-control font-loto"
                                                   placeholder="Enter number of guests"
                                                   value="{{@$asset->asset_accommodation_info['number_of_guest']}}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-12 validationNeed error_description">
                                            <label
                                                class="mt-4 required font-sf-pro validationNeed  ">DESCRIPTION</label>
                                            <textarea class="form-control font-loto description"
                                                      style="height: 120px !important;"
                                                      rows="4" name="description" placeholder="Enter description"
                                                      id="description-accommodation">{{$asset->description}}</textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <input type="file" id="accomodationFiles" name="images[]" multiple
                                               style="display:none" accept="image/*">
                                        <input type="text" id="accomodationFilesRemoved" name="imagesRemove"
                                               style="display:none">
                                    </div>
                                </form>
                            </div>

                            <div
                                class="dining tab-pane fade @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Dining) active show @endif"
                                role="tabpanel" aria-labelledby="nav-home-tab">
                                <form method="post" id="asset-dining-form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="category_id" class="form-control font-loto"
                                               value="{{ App\ModelsExtended\AssetCategory::Dining }}">
                                        <div class="row">
                                            <div class="col-sm-12 validationNeed">
                                                <label for="name" class="mt-4 required font-sf-pro">ASSET NAME</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="TThe name of the asset displayed as a listing"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <input type="name" required name="name" class="form-control font-loto"
                                                       value="{{$asset->name}}" placeholder="Enter asset name"
                                                       id="name">
                                                <input type="hidden" name="id" value="{{$asset->id}}">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 validationNeed">
                                                <label for="venue" class="mt-4 required font-sf-pro">VENUE NAME
                                                </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           data-bs-original-title="The name of the site or venue that is hosting the experience"
                                                           class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <div id="venueNameInputField">
                                                    <i class="fa fa-search prependIcon">
                                                    </i>
                                                    <div class="dropdown w-100">
                                                        <input type="text" name="venue"
                                                               class="form-control font-loto venue_name_dining"
                                                               placeholder="Search venue" autocomplete="off"
                                                               id="venue_name"
                                                               value="{{$asset->venue_name}}">
                                                        <div
                                                            class="dropdown-menu venueNameDropdown venueNameDropdownDining"
                                                            id="venueNameDropdown">
                                                            <i class="hasNoResults">No matching results</i>
                                                            <div class="list-autocomplete">
                                                                @foreach($venues as $venue )
                                                                    <button type="button" class="dropdown-item"
                                                                            address-value="{{$venue->address}}">{{ $venue->name}}</button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="address" class="mt-4 required font-sf-pro">VENUE
                                                    ADDRESS</label><i data-bs-toggle="tooltip"
                                                                      data-bs-placement="bottom"
                                                                      data-bs-original-title="The full address of the location/venue"
                                                                      class="fa fa-info-circle ms-1"
                                                                      aria-hidden="true"></i>

                                                <div id="venue-address-suggestions">
                                                    <i class="fa fa-map-marker prependIcon">
                                                    </i>
                                                    <input type="text" name="address"
                                                           class="venueAddAutosuggest form-control font-loto venueAddAutosuggestDining"
                                                           placeholder="Enter venue address" id="address"
                                                           value="{{$asset->venue_address}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="seller" class="mt-4 required font-sf-pro">SELLER</label>
                                                <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   data-bs-original-title="The name of the seller. If seller is not shown on the dropdown  options, you may add one."
                                                   class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <select class="form-control sellerSelect font-loto" name="seller"
                                                        id="sellerSelect">
                                                    @foreach($sellers as $seller)
                                                        <option value="{{$seller->id}}"
                                                            {{$asset->seller_id == $seller->id  ? 'selected' : ''}}>
                                                            {{$seller->first_name}} {{$seller->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="status" class="mt-4 required font-sf-pro">STATUS</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The availability of the asset"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <select class="form-control font-loto" name="status" required>
                                                    @foreach($statuses as $status)
                                                        <option value="{{$status->id}}"
                                                            {{$asset->asset_status_id == $status->id  ? 'selected' : ''}}>
                                                            {{$status->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="date" class="mt-4 required font-sf-pro">COST DETAILS</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The check in and check out date"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>

                                                <input class="form-control font-loto" type="text"
                                                       placeholder="Enter details" name="cost_details"
                                                       value="{{@$asset->asset_cost['cost_details']}}">
                                            </div>
                                            <div class="col-sm-6 validationNeed dateTimeOfReservation">
                                                <div>
                                                    <label for="date" class="mt-4 required font-sf-pro">date and time of
                                                        reservation
                                                    </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                               data-bs-original-title="The date and time of dining reservation"
                                                               class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                </div>
                                                <div class="btn-group w-100">
                                                    <div id="DinningDateOfReservation" class="w-50">
                                                        <i class="fa fa-calendar-o prependIcon">
                                                        </i>
                                                        <input type="text" class="form-control font-loto"
                                                               name="reservation_date"
                                                               id="DinningDateOfReservationField"
                                                               placeholder="January 1,2022"
                                                               value="{{convertDateWithMonthNameDayYear(@$asset->check_in_datetime)}}">
                                                        <span class="text-danger mt-2 error_reservation_date"></span>
                                                    </div>
                                                    <div id="DinningTimeOfReservation" class="w-50">
                                                        <i class="fa fa-clock-o prependIcon">
                                                        </i>
                                                        <input type="text" name="reservation_time"
                                                               class="form-control font-loto datetimepicker-input"
                                                               id="DinningTimeOfReservationField" placeholder="9:40 AM"
                                                               data-toggle="datetimepicker"
                                                               data-target="#DinningTimeOfReservationField"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed dateTimeOfReservation">
                                                <div>
                                                    <label for="date" class="mt-4 required font-sf-pro">date and time of
                                                        deadline</label><i data-bs-toggle="tooltip"
                                                                           data-bs-placement="bottom"
                                                                           data-bs-original-title="The date and time of deadline of dining reservation"
                                                                           class="fa fa-info-circle ms-1"
                                                                           aria-hidden="true"></i>
                                                </div>
                                                <div class="btn-group w-100">
                                                    <div id="DinningDateOfDeadline" class="w-50">
                                                        <i class="fa fa-calendar-o prependIcon">
                                                        </i>
                                                        <input type="text" class="form-control font-loto"
                                                               name="deadline_date" id="DinningDateOfDeadlineField"
                                                               placeholder="January 1,2022"
                                                               value="{{convertDateWithMonthNameDayYear(@$asset->deadline_datetime)}}">
                                                    </div>
                                                    <div id="DinningTimeOfDeadline" class="w-50">
                                                        <i class="fa fa-clock-o prependIcon">
                                                        </i>
                                                        <input type="text"
                                                               class="form-control font-loto datetimepicker-input"
                                                               name="deadline_time" id="DinningTimeOfDeadlineField"
                                                               placeholder="9:40 AM" data-toggle="datetimepicker"
                                                               data-target="#DinningTimeOfDeadlineField"
                                                               autocomplete="off"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="timezone" class="mt-4 font-sf-pro required">EVENT
                                                    TIMEZONE</label><i data-bs-toggle="tooltip"
                                                                       data-bs-placement="bottom"
                                                                       data-bs-original-title="The timezone of the event"
                                                                       class="fa fa-info-circle ms-1"
                                                                       aria-hidden="true"></i>
                                                <select class="form-control font-loto" name="timezone">
                                                    @foreach($timezones as $timezone)
                                                        <option value="{{$timezone->id}}"
                                                            {{@$asset->timezone_id == $timezone->id  ? 'selected' : ''}}
                                                        @if(!@$asset->timezone_id)
                                                            {{ \App\ModelsExtended\Timezone::EST == $timezone->id  ? 'selected' : ''}}
                                                            @endif
                                                        >
                                                            {{$timezone->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="no_of_guests" class="mt-4 required font-sf-pro">NUMBER OF
                                                    GUESTS </label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The total number of guests attending"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <input type="number" name="number_of_guest"
                                                       class="form-control font-loto"
                                                       value="{{@$asset->asset_dining_info['number_of_guest']}}"
                                                       placeholder="Enter number of guests" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 validationNeed error_description_dining">
                                                <label class="mt-4 required font-sf-pro">DESCRIPTION</label>
                                                <textarea class="form-control font-loto description"
                                                          style="height: 120px !important;"
                                                          rows="4" name="description" id="description-dining"
                                                          placeholder="Enter description">{{$asset->description}}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="file" id="diningFiles" name="images[]" multiple
                                                   style="display:none" accept="image/*">
                                            <input type="text" id="diningFilesRemoved" name="imagesRemove"
                                                   style="display:none">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div
                                class="event tab-pane fade @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Event) active show @endif"
                                role="tabpanel" aria-labelledby="nav-home-tab">
                                <form method="post" id="asset-event-form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="category_id" class="form-control font-loto"
                                               value="{{ App\ModelsExtended\AssetCategory::Event }}">
                                        <div class="row">
                                            <div class="col-sm-12 validationNeed">
                                                <label for="name" class="mt-4 required font-sf-pro">ASSET NAME</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The name of the asset displayed as a listing"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <input type="name" required name="name" class="form-control font-loto"
                                                       value="{{$asset->name}}" id="name"
                                                       placeholder="Enter asset name">
                                                <input type="hidden" name="id" value="{{$asset->id}}">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 validationNeed">
                                                <label for="venue" class="mt-4 required font-sf-pro">VENUE NAME
                                                </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           data-bs-original-title="The name of the site or venue that is hosting the experience"
                                                           class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <div id="venueNameInputField">
                                                    <i class="fa fa-search prependIcon">
                                                    </i>
                                                    <div class="dropdown w-100">
                                                        <input type="text" name="venue"
                                                               class="form-control font-loto venue_name_event"
                                                               placeholder="Search venue" autocomplete="off"
                                                               id="venue_name"
                                                               value="{{$asset->venue_name}}">
                                                        <div
                                                            class="dropdown-menu venueNameDropdown venueNameDropdownEvent"
                                                            id="venueNameDropdown">
                                                            <i class="hasNoResults">No matching results</i>
                                                            <div class="list-autocomplete">
                                                                @foreach($venues as $venue )
                                                                    <button type="button" class="dropdown-item"
                                                                            address-value="{{$venue->address}}">{{ $venue->name}}</button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="address" class="mt-4 required font-sf-pro">VENUE
                                                    ADDRESS</label><i data-bs-toggle="tooltip"
                                                                      data-bs-placement="bottom"
                                                                      data-bs-original-title="The full address of the location/venue"
                                                                      class="fa fa-info-circle ms-1"
                                                                      aria-hidden="true"></i>
                                                <div id="venue-address-suggestions">
                                                    <i class="fa fa-map-marker prependIcon">
                                                    </i>
                                                    <input type="text" name="address"
                                                           class="venueAddAutosuggest form-control font-loto venueAddAutosuggestEvent"
                                                           value="{{$asset->venue_address}}"
                                                           placeholder="Enter venue address"
                                                           id="address">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="seller" class="mt-4 required font-sf-pro">SELLER</label>
                                                <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   data-bs-original-title="The name of the seller. If seller is not shown on the dropdown  options, you may add one."
                                                   class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <select class="form-control sellerSelect font-loto" name="seller"
                                                        id="sellerSelect">
                                                    @foreach($sellers as $seller)
                                                        <option value="{{$seller->id}}"
                                                            {{$asset->seller_id == $seller->id  ? 'selected' : ''}}>
                                                            {{$seller->first_name}} {{$seller->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="status" class="mt-4 required font-sf-pro">STATUS</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The availability of the asset"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <select class="form-control font-loto" name="status">
                                                    @foreach($statuses as $status)
                                                        <option value="{{$status->id}}"
                                                            {{$asset->asset_status_id == $status->id  ? 'selected' : ''}}>
                                                            {{$status->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="date" class="mt-4 required font-sf-pro">COST DETAILS</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The check in and check out date"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>

                                                <input class="form-control font-loto" type="text"
                                                       placeholder="Enter details" name="cost_details"
                                                       value="{{@$asset->asset_cost['cost_details']}}">
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <div>
                                                    <label for="date" class="mt-4 required font-sf-pro">date and time of
                                                        event
                                                    </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                               data-bs-original-title="The date and time of asset reservation"
                                                               class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                </div>
                                                <div class="btn-group w-100">
                                                    <div id="EventDateOfReservation" class="w-50">
                                                        <i class="fa fa-calendar-o prependIcon">
                                                        </i>
                                                        <input type="text" name="event_date"
                                                               class="form-control font-loto"
                                                               id="EventDateOfReservationField"
                                                               placeholder="January 1,2022"
                                                               value="{{convertDateWithMonthNameDayYear(@$asset->check_in_datetime)}}">
                                                        <span class="text-danger mt-2 error_event_date"></span>
                                                    </div>
                                                    <div id="EventTimeOfReservation" class="w-50">
                                                        <i class="fa fa-clock-o prependIcon">
                                                        </i>
                                                        <input type="text" name="event_time"
                                                               class="form-control font-loto datetimepicker-input"
                                                               id="EventTimeOfReservationField" placeholder="9:40 AM"
                                                               data-toggle="datetimepicker"
                                                               data-target="#EventTimeOfReservationField"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <div>
                                                    <label for="date" class="mt-4 required font-sf-pro">Date and time of
                                                        deadline</label><i data-bs-toggle="tooltip"
                                                                           data-bs-placement="bottom"
                                                                           data-bs-original-title="The date and time of deadline of asset reservation"
                                                                           class="fa fa-info-circle ms-1"
                                                                           aria-hidden="true"></i>
                                                </div>
                                                <div class="btn-group w-100">
                                                    <div id="EventDateOfDeadline" class="w-50">
                                                        <i class="fa fa-calendar-o prependIcon">
                                                        </i>
                                                        <input type="text" class="form-control font-loto"
                                                               name="deadline_date" id="EventDateOfDeadlineField"
                                                               placeholder="January 1,2022"
                                                               value="{{convertDateWithMonthNameDayYear(@$asset->deadline_datetime)}}">
                                                    </div>
                                                    <div id="EventTimeOfDeadline" class="w-50">
                                                        <i class="fa fa-clock-o prependIcon">
                                                        </i>
                                                        <input type="text" name="deadline_time"
                                                               class="form-control font-loto datetimepicker-input"
                                                               id="EventTimeOfDeadlineField" placeholder="9:40 AM"
                                                               data-toggle="datetimepicker"
                                                               data-target="#EventTimeOfDeadlineField"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="timezone" class="mt-4 font-sf-pro required">EVENT
                                                    TIMEZONE</label><i data-bs-toggle="tooltip"
                                                                       data-bs-placement="bottom"
                                                                       data-bs-original-title="The timezone of the event"
                                                                       class="fa fa-info-circle ms-1"
                                                                       aria-hidden="true"></i>
                                                <select class="form-control font-loto" name="timezone">
                                                    @foreach($timezones as $timezone)
                                                        <option value="{{$timezone->id}}"
                                                            {{@$asset->timezone_id == $timezone->id  ? 'selected' : ''}}
                                                        @if(!@$asset->timezone_id)
                                                            {{ \App\ModelsExtended\Timezone::EST == $timezone->id  ? 'selected' : ''}}
                                                            @endif>
                                                            {{$timezone->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 validationNeed error_description_event">
                                                <label class="mt-4 required font-sf-pro">DESCRIPTION</label>
                                                <textarea class="form-control font-loto description"
                                                          style="height: 120px !important;"
                                                          rows="4" name="description" placeholder="Enter description"
                                                          id="description-event">{{$asset->description}}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="file" id="eventFiles" name="images[]" multiple
                                                   style="display:none"
                                                   accept="image/*">
                                            <input type="text" id="eventFilesRemoved" name="imagesRemove"
                                                   style="display:none">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div
                                class="misc tab-pane fade @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Miscellaneous) active show @endif"
                                role="tabpanel" aria-labelledby="nav-home-tab">
                                <form method="post" id="asset-misc-form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="category_id" class="form-control font-loto"
                                               value="{{ App\ModelsExtended\AssetCategory::Miscellaneous }}">
                                        <div class="row">
                                            <div class="col-sm-12 validationNeed">
                                                <label for="name" class="mt-4 required font-sf-pro">ASSET NAME</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The name of the asset displayed as a listing"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <input type="name" required name="name" class="form-control font-loto"
                                                       value="{{$asset->name}}" placeholder="Enter asset name"
                                                       placeholder="Enter asset name" id="name">
                                                <input type="hidden" name="id" value="{{$asset->id}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 validationNeed">
                                                <label for="venue" class="mt-4  font-sf-pro">VENUE NAME
                                                </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           data-bs-original-title="The name of the site or venue that is hosting the experience"
                                                           class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <div id="venueNameInputField">
                                                    <i class="fa fa-search prependIcon">
                                                    </i>
                                                    <div class="dropdown w-100">
                                                        <input type="text" name="venue"
                                                               class="form-control font-loto ignore venue_name_misc"
                                                               placeholder="Search venue" autocomplete="off"
                                                               id="venue_name"
                                                               value="{{$asset->venue_name}}">
                                                        <div
                                                            class="dropdown-menu venueNameDropdown venueNameDropdownMisc"
                                                            id="venueNameDropdown">
                                                            <i class="hasNoResults">No matching results</i>
                                                            <div class="list-autocomplete">
                                                                @foreach($venues as $venue )
                                                                    <button type="button" class="dropdown-item"
                                                                            address-value="{{$venue->address}}">{{ $venue->name}}</button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="address" class="mt-4  font-sf-pro">VENUE
                                                    ADDRESS</label><i data-bs-toggle="tooltip"
                                                                      data-bs-placement="bottom"
                                                                      data-bs-original-title="The full address of the location/venue"
                                                                      class="fa fa-info-circle ms-1"
                                                                      aria-hidden="true"></i>
                                                <div id="venue-address-suggestions">
                                                    <i class="fa fa-map-marker prependIcon">
                                                    </i>
                                                    <input type="text" name="address"
                                                           class="venueAddAutosuggest form-control font-loto venueAddAutosuggestMisc"
                                                           placeholder="Enter venue address" id="address"
                                                           value="{{$asset->venue_address}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="seller" class="mt-4 required font-sf-pro">SELLER</label>
                                                <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   data-bs-original-title="The name of the seller. If seller is not shown on the dropdown  options, you may add one."
                                                   class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <select class="form-control sellerSelect font-loto" name="seller"
                                                        id="sellerSelect">
                                                    @foreach($sellers as $seller)
                                                        <option value="{{$seller->id}}"
                                                            {{$asset->seller_id == $seller->id  ? 'selected' : ''}}>
                                                            {{$seller->first_name}} {{$seller->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="status" class="mt-4 required font-sf-pro">STATUS</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The availability of the asset"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <select class="form-control font-loto" name="status">
                                                    @foreach($statuses as $status)
                                                        <option value="{{$status->id}}"
                                                            {{$asset->asset_status_id == $status->id  ? 'selected' : ''}}>
                                                            {{$status->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="date" class="mt-4 required font-sf-pro">COST
                                                    DETAILS</label><i data-bs-toggle="tooltip"
                                                                      data-bs-placement="bottom"
                                                                      data-bs-original-title="The check in and check out date"
                                                                      class="fa fa-info-circle ms-1"
                                                                      aria-hidden="true"></i>

                                                <input class="form-control font-loto" type="text" name="cost_details"
                                                       placeholder="Enter details"
                                                       value="{{@$asset->asset_cost['cost_details']}}">
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="venue_layout" class="mt-4 font-sf-pro">VENUE
                                                    LAYOUT</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                     data-bs-original-title="A map of the venue to help the user visualize the seat area"
                                                                     class="fa fa-info-circle ms-1"
                                                                     aria-hidden="true"></i>
                                                <input type="text" name="venue_layout"
                                                       value="{{@$asset->asset_miscellaneous_info['venue_layout']}}"
                                                       class="form-control font-loto" placeholder="https://www.web.com">
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="cancellation_policy" class="mt-4 font-sf-pro">CANCELLATION
                                                    POLICY</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                     data-bs-original-title="A link to the event’s cancellation policy or verbiage to express the same"
                                                                     class="fa fa-info-circle ms-1"
                                                                     aria-hidden="true"></i>
                                                <input type="text" name="cancellation_policy"
                                                       value="{{@$asset->asset_miscellaneous_info['cancellation_policy']}}"
                                                       class="form-control font-loto" placeholder="https://www.website.com"
                                                       id="cancellation_policy">
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="display_date" class="mt-4  font-sf-pro">DATE</label><i
                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    data-bs-original-title="The date when guests are going to leave the venue"
                                                    class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                <input type="text" name="display_date"
                                                       value="{{@$asset->asset_miscellaneous_info['display_date']}}"
                                                       class="form-control font-loto" id="assetMiscDisplayDate" placeholder="Enter date">
                                                <span class="text-danger error_display_date"></span>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <div>
                                                    <label for="date" class="mt-4  font-sf-pro">Date and
                                                        time of
                                                        deadline
                                                    </label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                               data-bs-original-title="The date and time of deadline of asset reservation"
                                                               class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                                </div>
                                                <div class="btn-group w-100">
                                                    <div id="MiscDateOfDeadline" class="w-50">
                                                        <i class="fa fa-calendar-o prependIcon">
                                                        </i>
                                                        <input type="text" name="deadline_date"
                                                               class="form-control font-loto"
                                                               id="MiscDateOfDeadlineField"
                                                               placeholder="January 1,2022"
                                                               value="{{convertDateWithMonthNameDayYear(@$asset->deadline_datetime)}}">
                                                    </div>
                                                    <div id="MiseTimeOfDeadline" class="w-50">
                                                        <i class="fa fa-clock-o prependIcon">
                                                        </i>
                                                        <input type="text" name="deadline_time"
                                                               class="form-control font-loto datetimepicker-input"
                                                               id="MiseTimeOfDeadlineField" placeholder="9:40 AM"
                                                               data-toggle="datetimepicker"
                                                               data-target="#MiseTimeOfDeadlineField"
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 validationNeed">
                                                <label for="timezone" class="mt-4 font-sf-pro ">EVENT
                                                    TIMEZONE</label><i data-bs-toggle="tooltip"
                                                                       data-bs-placement="bottom"
                                                                       data-bs-original-title="The timezone of the event"
                                                                       class="fa fa-info-circle ms-1"
                                                                       aria-hidden="true"></i>
                                                <select class="form-control font-loto" name="timezone">
                                                    @foreach($timezones as $timezone)
                                                        <option value="{{$timezone->id}}"
                                                            {{@$asset->timezone_id == $timezone->id  ? 'selected' : ''}}
                                                        @if(!@$asset->timezone_id)
                                                            {{ \App\ModelsExtended\Timezone::EST == $timezone->id  ? 'selected' : ''}}
                                                            @endif>
                                                            {{$timezone->description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 validationNeed error_description_misc">
                                                <label class="mt-4 required font-sf-pro">DESCRIPTION</label>
                                                <textarea class="form-control font-loto description"
                                                          style="height: 120px !important;"
                                                          rows="4" name="description" placeholder="Enter description"
                                                          id="description-misc">{{$asset->description}}</textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <input type="file" id="miscFiles" name="images[]" multiple
                                                   style="display:none"
                                                   accept="image/*">
                                            <input type="text" id="miscFilesRemoved" name="imagesRemove"
                                                   style="display:none">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div
                    class="accommodation tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Accommodation) active show @elseif($asset->id == null) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Photos</h5>
                        <div class="d-flex align-item-center mt-4">
                            <!-- Preview collection of uploaded documents -->
                            <div class="me-2 uploadedFilePreview" id="uploadedFilePreviewAccomodation"
                                 style="@if(@count($asset->asset_images)>0) display:flex @else display:none @endif">
                                @if(@count($asset->asset_images) > 0)
                                    @foreach($asset->asset_images as $image)
                                        <span class="pip" id="accommodation-{{$image->id}}">
                                <img class="imageThumbList" src="{{$image->image_url}}"> <i class="fa fa-times remove"
                                                                                            onclick="removeUploadedFiles('{{$image->id}}','#accomodationFilesRemoved','accommodation')"
                                                                                            aria-hidden="true"></i>
                            </span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="fileUploadExplorer" onclick="doOpenAccomodationFiles(event)">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <h6>Upload new photo</h6>
                                <!-- <input type="file" id="accomodationFiles" name="files[]" multiple style="display:none"
                                        accept="image/*"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="dining tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Dining) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Photos</h5>
                        <div class="d-flex align-item-center mt-4">
                            <!-- Preview collection of uploaded documents -->
                            <div class="me-2 uploadedFilePreview" id="uploadedFilePreviewDining"
                                 style="@if(@count($asset->asset_images)>0) display:flex @else display:none @endif">
                                @if(@count($asset->asset_images) > 0)
                                    @foreach($asset->asset_images as $image)
                                        <span class="pip" id="dining-{{$image->id}}">
                                <img class="imageThumbList" src="{{$image->image_url}}"> <i class="fa fa-times remove"
                                                                                            onclick="removeUploadedFiles('{{$image->id}}','#diningFilesRemoved','dining')"
                                                                                            aria-hidden="true"></i>
                            </span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="fileUploadExplorer" onclick="doOpenDiningFiles(event)">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <h6>Upload new photo</h6>
                                <!-- <input type="file" id="diningFiles" name="files[]" multiple style="display:none"
                                    accept="image/*"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="event tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Event) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Photos</h5>
                        <div class="d-flex align-item-center mt-4">
                            <!-- Preview collection of uploaded documents -->
                            <div class="me-2 uploadedFilePreview" id="uploadedFilePreviewEvent"
                                 style="@if(@count($asset->asset_images)>0) display:flex @else display:none @endif">
                                @if(@count($asset->asset_images) > 0)
                                    @foreach($asset->asset_images as $image)
                                        <span class="pip" id="event-{{$image->id}}">
                                <img class="imageThumbList" src="{{$image->image_url}}"> <i class="fa fa-times remove"
                                                                                            onclick="removeUploadedFiles('{{$image->id}}','#eventFilesRemoved','event')"
                                                                                            aria-hidden="true"></i>
                            </span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="fileUploadExplorer" onclick="doOpenEventFiles(event)">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <h6>Upload new photo</h6>
                                <!-- <input type="file" id="eventFiles" name="files[]" multiple style="display:none"
                                    accept="image/*"> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="misc tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Miscellaneous) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Photos</h5>
                        <div class="d-flex align-item-center mt-4">
                            <!-- Preview collection of uploaded documents -->
                            <div class="me-2 uploadedFilePreview" id="uploadedFilePreviewMisc"
                                 style="@if(@count($asset->asset_images)>0) display:flex @else display:none @endif">
                                @if(@count($asset->asset_images) > 0)
                                    @foreach($asset->asset_images as $image)
                                        <span class="pip" id="misc-{{$image->id}}">
                                <img class="imageThumbList" src="{{$image->image_url}}"> <i class="fa fa-times remove"
                                                                                            onclick="removeUploadedFiles('{{$image->id}}','#miscFilesRemoved','misc')"
                                                                                            aria-hidden="true"></i>
                            </span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="fileUploadExplorer" onclick="doOpenMiscFiles(event)">
                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                <h6>Upload new photo</h6>
                                <!-- <input type="file" id="miscFiles" name="files[]" multiple style="display:none"
                                    accept="image/*"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div
                    class="accommodation tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Accommodation) active show @elseif($asset->id == null) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Internal Notes</h5>
                        <form method="post" id="asset-form-more-info">
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="confirmation_number font-sf-pro" class="mt-4">CONFIRMATION
                                        NUMBER</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                         data-bs-original-title="The confirmation number given to the contact person by the venue host"
                                                         class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="number" name="confirmation_number" class="form-control font-loto"
                                           value="{{@$asset->asset_accommodation_info['confirmation_number']}}"
                                           id="confirmation_number" placeholder="Enter confirmation number">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="guest_name" class="mt-4 font-sf-pro">GUEST NAME</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The name of the guest who will serve as the group’s contact person"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="guest_name" class="form-control font-loto"
                                           value="{{@$asset->asset_accommodation_info['guest_name']}}" id="guest_name"
                                           placeholder="Enter guest name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="venue_phone" class="mt-4 font-sf-pro">VENUE PHONE NUMBER</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The venue’s primary phone number"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="tel" name="venue_phone" maxlength="20" class="form-control font-loto"
                                           id="venue_phone" placeholder="e.g. +1800001111"
                                           value="{{@$asset->asset_accommodation_info['venue_phone']}}">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="cancellation_cost" class="mt-4 font-sf-pro">CANCELLATION
                                        COST</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                       data-bs-original-title="The cost that will be charged if guests decide to cancel the accommodation booking"
                                                       class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="number" name="cancellation_cost" class="form-control font-loto"
                                           value="{{@$asset->asset_accommodation_info['cancellation_cost']}}"
                                           id="cancellation_cost" placeholder="Enter cancellation cost">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="website" class="mt-4 font-sf-pro">WEBSITE</label><i
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-original-title="A link to the venue’s website"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="url" name="website" class="form-control font-loto"
                                           value="{{@$asset->asset_accommodation_info['website']}}" id="website"
                                           placeholder="https:://www.website.com">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="cancellation_policy font-sf-pro" class="mt-4">CANCELLATION
                                        POLICY</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                         data-bs-original-title="A link to the event’s cancellation policy or verbiage to express the same"
                                                         class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="url" name="cancellation_policy" class="form-control font-loto"
                                           value="{{@$asset->asset_accommodation_info['cancellation_policy']}}"
                                           id="cancellation_policy" placeholder="https://www.website.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed">
                                    <label for="notes" class="mt-4 font-sf-pro">NOTES</label>
                                    <textarea type="textarea" name="notes" class="form-control font-loto"
                                              style="height: 90px !important;" id="notes"
                                              placeholder="Enter other notes">{{$asset->notes}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 accomodationTagInput">
                                    <label for="tags" class="mt-4 font-sf-pro">TAGS/RELATED INTERESTS</label>
                                    <input type="text" name="tags" class="form-control font-loto"
                                           value="{{arrayToCommaSeparatedTags(@$asset->asset_tags)}}"
                                           id="accomodationTagInput"
                                           placeholder="Enter tags/related interests">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div
                    class="dining tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Dining) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Internal Notes</h5>
                        <form method="post" id="asset-dining-form-more-info">
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="guest_name" class="mt-4 font-sf-pro">GUEST NAME</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The name of the guest who will serve as the group’s contact person"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="guest_name" class="form-control font-loto"
                                           value="{{@$asset->asset_dining_info['guest_name']}}"
                                           placeholder="Enter guest name"
                                           id="guest_name">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="guest_name" class="mt-4 font-sf-pro">GUEST EMAIL</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The guest’s email where he/she wants to be contacted"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="email" name="guest_email" class="form-control font-loto"
                                           value="{{@$asset->asset_dining_info['guest_email']}}"
                                           placeholder="name@gmail.com">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="no_of_guests" class="mt-4 font-sf-pro">GUEST PHONE</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The guest’s primary phone number"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="tel" name="guest_phone" maxlength="20" class="form-control font-loto"
                                           id="guest_phone" placeholder="e.g. +1800001111"
                                           value="{{@$asset->asset_dining_info['guest_phone']}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="venue_phone" class="mt-4 font-sf-pro">VENUE PHONE NUMBER</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The venue’s primary phone number"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="tel" name="venue_phone" maxlength="20" placeholder="e.g. +1800001111"
                                           class="form-control font-loto" id="venue_phone"
                                           value="{{@$asset->asset_dining_info['venue_phone']}}">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="cancellation_policy" class="mt-4 font-sf-pro">CANCELLATION
                                        POLICY</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                         data-bs-original-title="A link to the restaurant’s cancellation policy or verbiage to express the same"
                                                         class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="cancellation_policy" class="form-control font-loto"
                                           value="{{@$asset->asset_dining_info['cancellation_policy']}}"
                                           placeholder="https://www.website.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed">
                                    <label for="menu_highlights" class="mt-4 font-sf-pro">MENU HIGHLIGHTS</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The menu’s highlights and bestselling dishes"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <textarea type="textarea" placeholder="Enter menu highlights" name="menu_highlights"
                                              class="form-control font-loto" style="height: 120px !important;"
                                              placeholder="Enter nemu highlights">{{@$asset->asset_dining_info['menu_highlights']}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed">
                                    <label for="notes" class="mt-4 font-sf-pro">NOTES</label>
                                    <textarea type="textarea" name="notes" class="form-control font-loto"
                                              style="height: 120px !important;"
                                              placeholder="Enter notes">{{$asset->notes}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed dinningTagInput">
                                    <label for="tags" class="mt-4 font-sf-pro">TAGS/RELATED INTERESTS</label>
                                    <input type="text" name="tags" class="form-control font-loto"
                                           value="{{arrayToCommaSeparatedTags(@$asset->asset_tags)}}"
                                           id="dinningTagInput"
                                           placeholder="Enter tags/related interests">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div
                    class="event tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Event) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Internal Notes</h5>
                        <form method="post" id="asset-event-form-more-info">
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="event_name" class="mt-4 font-sf-pro">EVENT NAME</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The name of the event, which may not be the same as the title of the listing"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="event_name" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['event_name']}}" id="event_name"
                                           placeholder="Enter event name">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="event_type" class="mt-4 font-sf-pro">EVENT TYPE</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The type of the event, displayed as a typehead text field"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="event_type" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['event_type']}}"
                                           placeholder="Enter event type">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="ticket_holder" class="mt-4 font-sf-pro">TICKET HOLDER</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The name of the person who originally purchased the tickets"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="ticket_holder" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['ticket_holder']}}" id="ticket_holder"
                                           placeholder="Enter name">
                                </div>
                                <div class="col-sm-3 validationNeed">
                                    <label for="no_of_tickets" class="mt-4 font-sf-pro">NUMBER OF TICKETS</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The number of tickets being sold"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="number" name="number_of_seats" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['number_of_seats']}}" placeholder="1">
                                </div>
                                <div class="col-sm-3 validationNeed">
                                    <label for="seat_area" class="mt-4 font-sf-pro">SEAT AREA</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The area in which the seats are located"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="seat_area" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['seat_area']}}" id="seat_area"
                                           placeholder="Enter seat area">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="venue_layout" class="mt-4 font-sf-pro">VENUE LAYOUT</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="A map of the venue to help the user visualize the seat area"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="venue_layout" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['venue_layout']}}" id="venue_layout"
                                           placeholder="https://www.website.com">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="cancellation_policy" class="mt-4 font-sf-pro">CANCELLATION
                                        POLICY</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                         data-bs-original-title="A link to the event’s cancellation policy or verbiage to express the same"
                                                         class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="cancellation_policy" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['cancellation_policy']}}"
                                           id="cancellation_policy" placeholder="https://www.website.com">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="total_paid" class="mt-4 font-sf-pro">TOTAL PAID</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The amount of money paid for the tickets; may not match the cost of the listing"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="number" name="total_paid" class="form-control font-loto"
                                           value="{{@$asset->asset_event_info['total_paid']}}" id="total_paid"
                                           placeholder="USD 0.00">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed">
                                    <label for="venue_amenities" class="mt-4 font-sf-pro">VENUE AMENITIES</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="Any other amenities that may come with the tickets wheather it be backstage/VIP access, a sponsors booth, etc."
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <textarea type="textarea" name="venue_amenities" class="form-control font-loto"
                                              style="height: 120px !important;" id="venue_amenities"
                                              placeholder="Enter venue amenities">{{@$asset->asset_event_info['venue_amenities']}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed">
                                    <label for="notes" class="mt-4 font-sf-pro">NOTES</label>
                                    <textarea type="textarea" placeholder="Enter notes" name="notes"
                                              class="form-control font-loto" style="height: 120px !important;"
                                              id="notes">{{$asset->notes}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 eventTagInput">
                                    <label for="tags" class="mt-4 font-sf-pro">TAGS/RELATED INTERESTS</label>
                                    <input type="text" name="tags" class="form-control font-loto"
                                           value="{{arrayToCommaSeparatedTags(@$asset->asset_tags)}}" id="eventTagInput"
                                           placeholder="Enter tags/related interests">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div
                    class="misc tab-pane fade card o-hidden @if(@$asset->asset_category_id == App\ModelsExtended\AssetCategory::Miscellaneous) active show @endif"
                    role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <h5 class="assetFormMereInfoTitle font-loto fw-400">Internal Notes</h5>
                        <form method="post" id="asset-misc-form-more-info">
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="event_name" class="mt-4 font-sf-pro">EVENT NAME</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The name of the event, which may not be the same as the title of the listing"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="event_name" class="form-control font-loto"
                                           value="{{@$asset->asset_miscellaneous_info['event_name']}}" id="event_name"
                                           placeholder="Enter event name">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="event_type" class="mt-4 font-sf-pro">EVENT TYPE</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The type of the event, displayed as a typehead text field"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="event_type" class="form-control font-loto"
                                           value="{{@$asset->asset_miscellaneous_info['event_type']}}"
                                           placeholder="Enter event type">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="ticket_holder" class="mt-4 font-sf-pro">TICKET HOLDER</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The name of the person who originally purchased the tickets"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="ticket_holder" class="form-control font-loto"
                                           value="{{@$asset->asset_miscellaneous_info['ticket_holder']}}"
                                           id="ticket_holder"
                                           placeholder="Enter name">
                                </div>
                                <div class="col-sm-3 validationNeed">
                                    <label for="no_of_seats" class="mt-4 font-sf-pro">NUMBER OF SEATS</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The number of tickets being sold"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="number" name="number_of_seats"
                                           value="{{@$asset->asset_miscellaneous_info['number_of_seats']}}"
                                           placeholder="Enter number of seats" class="form-control font-loto">
                                </div>
                                <div class="col-sm-3 validationNeed">
                                    <label for="seat_area" class="mt-4 font-sf-pro">SEAT AREA</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The area in which the seats are located"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="seat_area" class="form-control font-loto"
                                           value="{{@$asset->asset_miscellaneous_info['seat_area']}}"
                                           placeholder="Enter seat area" placeholder="Enter seat area">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 validationNeed">
                                    <label for="multiple_locations" class="mt-4 font-sf-pro">MULTIPLE
                                        LOCATIONS</label><i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-original-title="Any other event locations in this package aside from the main venue"
                                                            class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="text" name="multiple_locations" class="form-control font-loto"
                                           value="{{@$asset->asset_miscellaneous_info['multiple_locations']}}"
                                           placeholder="Enter location">
                                </div>
                                <div class="col-sm-6 validationNeed">
                                    <label for="total_paid" class="mt-4 font-sf-pro">TOTAL PAID</label><i
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-original-title="The amount of money paid for the tickets; may not match the cost of the listing"
                                        class="fa fa-info-circle ms-1" aria-hidden="true"></i>
                                    <input type="number" name="total_paid" class="form-control font-loto"
                                           value="{{@$asset->asset_miscellaneous_info['total_paid']}}"
                                           placeholder="USD 0.00">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 validationNeed">
                                    <label for="notes" class="mt-4 font-sf-pro">NOTES</label>
                                    <textarea type="textarea" name="notes" class="form-control font-loto"
                                              style="height: 120px !important;" placeholder="Enter description"
                                              id="notes">{{$asset->notes}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 miscTagInput">
                                    <label for="tags" class="mt-4 font-sf-pro">TAGS/RELATED INTERESTS</label>
                                    <input type="text" name="tags" class="form-control font-loto"
                                           value="{{arrayToCommaSeparatedTags(@$asset->asset_tags)}}" id="miscTagInput"
                                           placeholder="Enter tags/related intersts">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="display: none; max-width:700px;" id="add-new-seller-pop-up">
        <div class="card-body p-3">
            <h5 class="font-loto fw-700">Add new seller</h5>
            <form method="post" id="add-new-seller-form">
                <div class="form-group font-loto mt-4">
                    <div class="row">
                        <div class="col-sm-6 ">
                            <label for="first_name" class="mt-2 font-sf-pro">First Name</label>
                            <input type="text" name="first_name" class="form-control font-loto"
                                   placeholder="Enter first name">
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name" class="mt-2 font-sf-pro">Last Name</label>
                            <input type="text" name="last_name" class="form-control font-loto"
                                   placeholder="Enter last name">
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-5">
                <div class="col-sm-6 ">
                    <button class="cancel-btn font-loto fw-600" data-fancybox-close>Cancel</button>
                </div>
                <div class="col-sm-6 ">
                    <button class="addnew-seller-btn font-loto fw-600">Add New Seller</button>
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

    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>

    <script src="{{asset('/assets/js/datepicker/date-time-picker/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>


    <script src="{{asset('assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-time-picker/tempusdominus-bootstrap-4.min.js')}}">
    </script>

    <script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
    <script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>


    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-tagsinput.min.js') }}"></script>

    <script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script src="{{asset('assets/js/assets.js?' . rand() )}}"></script>


    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script> -->
    <script>
        $(document).ready(function () {
            $(function () {
                @if(@$asset['id'] != null)
                $("#dates").daterangepicker({
                    locale: {
                        format: "MMMM Do, YYYY",
                    },
                    language: "en",
                });

                $(
                    "#accommodationDeadlineDateField,#check_in,#check_out,#DinningDateOfReservationField,#DinningDateOfDeadlineField,#EventDateOfReservationField,#EventDateOfDeadlineField,#EventDateOfDeadlineField,#assetDateField,#MiscDateOfDeadlineField,#MiscFirstEventDateField,#MiscLastEventDateField,#accommodationDateCheckinield,#accommodationDateCheckoutField"
                ).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: "MMMM Do, YYYY",
                    },
                    language: "en",
                });

                $(
                    "#accommodationDeadlineTimeField,#DinningTimeOfReservationField,#DinningTimeOfDeadlineField,#EventTimeOfReservationField,#EventTimeOfDeadlineField,#MiseTimeOfDeadlineField,#MiscFirstEventTimeField,#MiscLastEventTimeField,#accommodationCheckinTimeField,#accommodationCheckoutTimeField"
                ).datetimepicker({
                    format: "LT",
                });

                // set edit value
                $("#accommodationDeadlineTimeField,#DinningTimeOfDeadlineField,#EventTimeOfDeadlineField,#MiseTimeOfDeadlineField")
                    .datetimepicker(
                        "date",
                        moment("{{convertDateTOTime(@$asset->deadline_datetime)}}", "LT")
                    );
                $("#DinningTimeOfReservationField,#EventTimeOfReservationField")
                    .datetimepicker(
                        "date",
                        moment("{{convertDateTOTime(@$asset->check_in_datetime)}}", "LT")
                    );
                @else
                $("#dates").daterangepicker({
                    locale: {
                        format: "MMMM Do, YYYY",
                    },
                    language: "en",
                    minDate: new Date(),
                });

                $(
                    "#assetMiscDisplayDate,#accommodationDeadlineDateField,#check_in,#check_out,#DinningDateOfReservationField,#DinningDateOfDeadlineField,#EventDateOfReservationField,#EventDateOfDeadlineField,#EventDateOfDeadlineField,#assetDateField,#MiscDateOfDeadlineField,#MiscFirstEventDateField,#MiscLastEventDateField,#accommodationDateCheckinield,#accommodationDateCheckoutField"
                ).daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    startDate: moment().add(1, 'month'),
                    locale: {
                        format: "MMMM Do, YYYY",
                    },
                    language: "en",
                    minDate: new Date(),
                });

                $('#EventDateOfReservationField').on('apply.daterangepicker', (e, picker) => {
                    var date = $('#EventDateOfReservationField').val();
                    var tempDate = new Date(moment(date, 'MMMM Do, YYYY'));
                    $('#EventDateOfDeadlineField').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        setDate: null,
                        locale: {
                            format: "MMMM Do, YYYY",
                        },
                        language: "en",
                        minDate: new Date(),
                        maxDate: tempDate

                    })
                });
                $('#accommodationDateCheckinield').on('apply.daterangepicker', (e, picker) => {
                    var accommodationDateCheckin = $('#accommodationDateCheckinield').val();
                    var tempAccommodationDateCheckin = new Date(moment(accommodationDateCheckin, 'MMMM Do, YYYY'));
                    $('#accommodationDeadlineDateField').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        setDate: null,
                        locale: {
                            format: "MMMM Do, YYYY",
                        },
                        language: "en",
                        minDate: new Date(),
                        maxDate: tempAccommodationDateCheckin

                    })
                });
                $('#accommodationDateCheckoutField').on('apply.daterangepicker', (e, picker) => {
                    var accommodationDateCheckout = $('#accommodationDateCheckoutField').val();
                    var tempAccommodationDateCheckout = new Date(moment(accommodationDateCheckout, 'MMMM Do, YYYY'));
                    $('#accommodationDeadlineDateField').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        setDate: null,
                        locale: {
                            format: "MMMM Do, YYYY",
                        },
                        language: "en",
                        minDate: new Date(),
                        maxDate: tempAccommodationDateCheckout

                    })
                });
                $('#DinningDateOfReservationField').on('apply.daterangepicker', (e, picker) => {
                    var dinningDateOfReservationField = $('#DinningDateOfReservationField').val();
                    var tempDinningDateOfReservationField = new Date(moment(dinningDateOfReservationField, 'MMMM Do, YYYY'));
                    $('#DinningDateOfDeadlineField').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        setDate: null,
                        locale: {
                            format: "MMMM Do, YYYY",
                        },
                        language: "en",
                        minDate: new Date(),
                        maxDate: tempDinningDateOfReservationField

                    })
                });

                $('#assetMiscDisplayDate').on('apply.daterangepicker', (e, picker) => {
                    var assetMiscDisplayDate = $('#assetMiscDisplayDate').val();
                    var tempAssetMiscDisplayDate = new Date(moment(assetMiscDisplayDate, 'MMMM Do, YYYY'));
                    $('#MiscDateOfDeadlineField').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        setDate: null,
                        locale: {
                            format: "MMMM Do, YYYY",
                        },
                        language: "en",
                        minDate: new Date(),
                        maxDate: tempAssetMiscDisplayDate

                    })
                });

                $(
                    "#accommodationDeadlineTimeField,#DinningTimeOfReservationField,#DinningTimeOfDeadlineField,#EventTimeOfReservationField,#EventTimeOfDeadlineField,#MiseTimeOfDeadlineField,#MiscFirstEventTimeField,#MiscLastEventTimeField,#accommodationCheckinTimeField,#accommodationCheckoutTimeField"
                ).datetimepicker({
                    format: "LT",
                });
                @endif




            });
        });
    </script>
@endsection
