<?php /* @var \Illuminate\Database\Eloquent\Collection $assetReceiverList */?>
<style>
    .assetDetailsCategory {
        font-weight: 400;
        font-size: 14px;
        line-height: 18px;
        color: #677281;
        margin-bottom: 5px !important;
    }

    .assetDetailsName {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 700;
        font-size: 28px;
        line-height: 33px;
        color: #0D203A;
    }

    .assetDetailsAddress {
        font-weight: 500;
        font-size: 12px;
        line-height: 14px;
        color: #000000;
    }

    .assetDetailsDescription {
        font-weight: 400;
        font-size: 12px;
        line-height: 17px;
        color: #000000;
    }

    .assetDetailsPriceTitle {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 10px;
        line-height: 12px;
        letter-spacing: 0.14em;
        color: #000000;
        opacity: 0.6;
    }

    .assetDetailsPrice {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 26px;
        line-height: 31px;
        color: #000000;
    }


    .assetDetailsDate {
        position: absolute;
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 16px;
        line-height: 19px;
    }

    .assetDetailsTime {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 16px;
        line-height: 19px;
        color: #000000;

    }

    .assetDetailsDateTitle,
    .assetDetailsPartySizeTitle,
    .assetDetailsTimeTitle {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 10px;
        line-height: 12px;
        letter-spacing: 0.14em;
        color: #000000;
        opacity: 0.6;
    }

    .assetDetailsPartySize {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 16px;
        line-height: 19px;
        color: #000000;
    }

    .assetDetailsTagsTitle {
        font-family: 'SF Pro Text';
        font-style: normal;
        font-weight: 700;
        font-size: 12px;
        line-height: 22px;
        color: #4D5997;
    }

    .assetDetailsTags {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 12px;
        line-height: 20px;
        color: #FFFFFF;
    }

    .shareBtn {
        background: #4D5997;
        border-radius: 10px;
        font-style: normal;
        font-weight: 700;
        font-size: 12px;
        line-height: 14px;
        text-align: center;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        color: #FFFFFF;
        text-decoration: none;
        padding: 10px;
    }

    .shareBtn:hover {
        color: #FFFFFF !important
    }

    .dropdown-menu {
        box-shadow: 0px 8px 16px rgb(0 0 0 / 15%) !important;
    }

    .dropdown-item {
        opacity: 1 !important
    }

    .coverPhoto {
        object-fit: cover;   
        max-height: 297px;     
    }

    .share-asset-modal .modal-dialog {
        max-width: 608px;
        position: absolute;
        min-width: 608px;
        top: 46%;
        left: 50%;
        transform: translate(-50%, -50%) !important;
    }

    .share-asset-modal .modal-content {
        border-radius: 30px;
        padding-top: 15px;
    }

    .share-asset-modal .modal-content .modal-body {
        padding-left: 40px;
    }

    .borderNone {
        border: 0px;
    }

    .fillBtnLg {
        width: 92%;
        padding: 10px;
        border-radius: 5px;
        margin: 0 auto;
        margin-bottom: 15px;
    }

    .modalTitle {
        padding: 5px 20px;
        padding-left: 40px !important;

    }

    .modalTitle h5 {
        font-size: 24px;
        font-weight: 600;
    }

    .modalTitle p {
        display: block;
    }

    .assetMemberList img {
        border-radius: 50%;
    }

    .listItem {
        display: flex;
        align-items: center;
    }

    .listItem div {
        margin-right: 10px;
        margin-top: 10px;
    }

    .crossBtnIcon {
        margin-right: 20px;
        position: absolute;
        right: 10px;
        top: 30px;
    }

    .displayBlock {
        display: block;
    }

    .modalCardArea {
        background-color: #F7F7F7;
        padding: 20px;
        border-radius: 12px;
    }

    .userInfoBar {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .userNotiBox {
        width: 40px;
        border-right: 1px solid #000;
        display: flex;
    }

    .userInfoBar span {
        font-size: 12px;
    }

    .userInfoBar {
        display: flex;
    }

    .userInfoBar span {
        font-size: 11px;
    }

    .addressBar {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .calanderBar {
        width: 160px;
        border-right: 1px solid #000;
        display: flex;
        gap: 7px;
    }

    h6.assetName {
        font-weight: 600;
    }
    .member_list {
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .searchBY {
        margin-top: 20px;
    }
    .group_list {
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .select2-selection__rendered{
        display: flex !important;
        padding: 2px !important;
        align-items: center !important;
    }
    .select2-selection__clear{
        position: absolute !important;
        right: 0 !important;
        top: -2px !important;
    }
    .shareAssetBtnGroup{
        display: flex;
        gap: 10px;
        padding: 0;
        flex-flow: initial;
    }
    .shareAssetBtnGroup button:nth-child(1){
        background-color: unset !important;
        padding: 10px;
        top: 0;
        width: 50%;
        color: #000;
        border-radius: 5px;
        border: 1px solid #000 !important;
    }
    .shareAssetBtnGroup button:nth-child(2){
        width: 50% !important;
        margin: 0 !important;
    }
    .calenderSvg{
        width: 15px;
        height: 15px;
    }
    .calenderSvg path, #addressSvg path{
        fill: gray;
    }
    #addressSvg{
        width: 15px;
        height: 15px;
    }
    .imageList{
        display: flex;
        align-items: center;
    }
    .shareUser{
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 100px;
        border: 3px solid #fff;
    }
    .countMember{
        display: block;
        width: 40px;
        height: 40px;
        background: #7B61FF;
        border-radius: 100px;
        color: #fff;
        text-align: center;
        line-height: 36px;
        font-size: 12px;
        border: 3px solid #fff;
    }
    .shareUser-1{
        position: relative;
        left: -14px;
        z-index: 2;
    }
    .shareUser-2{
        position: relative;
        left: -28px;
        z-index: 3;
    }
    .shareUser-4{
        position: relative;
        left: -44px;
        z-index: 4;
        font-weight: 600;
    }
    .assetShareMembers {
        display: flex;
        align-items: center;
    }
    .totalMembers span{
        color: black;
        font-size: 16px;
    }
    .totalMembers a{
        font-size: 16px;
        font-weight: 600;
    }

    .dropdown .dropdown-menu .dropdown-item {
        text-transform: uppercase;
        font-size: 11px;
        line-height: 21px;
    }

    .red-menu {
        color: #FF8989;
    }

    #sendPaymentLinkModal .modal-content {
        min-width: 792px;
        background: #FFFFFF;
        border-radius: 30px;
        padding: 40px;
    }

    #sendPaymentLinkModal .modal-body {
        padding: 0px;
    }

    #sendPaymentLinkModal .modal-title-info {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 700;
        font-size: 27px;
        line-height: 34px;
        color: #000000;
    }

    #sendPaymentLinkModal .modal-description {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-size: 10px;
        line-height: 19px;
        color: #000000;
    }

    #sendPaymentLinkModal .modal-description-detail {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-size: 10px;
        line-height: 19px;
        color: #000000;
        margin-top: 12px;
    }

    #sendPaymentLinkModal .modal-footer {
        border: none;
        margin-top: 32px;
    }

    #sendPaymentLinkModal .assetDetailsCategoryModal {
        font-style: normal;
        font-weight: 600;
        font-size: 9px;
        line-height: 11px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #949499;
    }

    #sendPaymentLinkModal .assetDetailsNameModal {
        font-family: 'SF Pro Text';
        font-style: normal;
        font-weight: 700;
        font-size: 13px;
        line-height: 21px;
        color: #313133;
    }

    #sendPaymentLinkModal .modal-detail-content-container {
        width: 100%;
        background: #F7F7F7;
        border-radius: 12px;
        padding: 16px;
        margin-top: 32px;
    }

    #sendPaymentLinkModal .modal-main-info-wrapper {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #sendPaymentLinkModal .modal-main-info-wrapper-right {
        display: flex;
        align-items: center;
    }

    #sendPaymentLinkModal .assetPriceModal {
        font-style: normal;
        font-weight: 590;
        font-size: 25px;
        line-height: 30px;
        color: #000000;
    }

    #sendPaymentLinkModal .assetDetailsCostLabelModal {
        font-style: normal;
        font-weight: 590;
        font-size: 9px;
        line-height: 11px;
        letter-spacing: 0.14em;
        color: #000000;
        opacity: 0.6;
        margin-right: 12px;
        margin-top: 8px;
        text-transform: uppercase;
    }

    #assetDateTimeModal {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-size: 10px;
        line-height: 19px;
        color: #636266;
    }

    #assetAddressModal {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-size: 10px;
        line-height: 19px;
        color: #636266;
    }

    #assetUserInfoModal {
        font-family: 'Lato';
        font-style: normal;
        font-weight: 400;
        font-size: 10px;
        line-height: 19px;
        color: #636266;
    }

    #sendPaymentLinkModal .modal-icon {
        width: 12px;
    }

    #sendPaymentLinkModal .cancel-modal-btn{
        width: 45%;
        height: 54px;
        background: transparent;
        border: 1px solid #D9D9D9;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Lato';
        font-style: normal;
        font-weight: 500;
        font-size: 11px;
        line-height: 21px;
        text-align: center;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        color: #636266;
        margin: auto;
    }

    #sendPaymentLinkModal .send-payment-link-btn {
        width: 45%;
        height: 54px;
        background: #4D5997;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Lato';
        font-style: normal;
        font-weight: 500;
        font-size: 11px;
        line-height: 21px;
        text-align: center;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        color: #FFFFFF;
        margin: auto;
    }

    .text-red {
        color: #FF8989;
    }

    #message-input {
        width: 100%;
        background: #FFFFFF;
        border: 1px solid rgba(0, 0, 0, 0.1);
        margin-top: 10px;
    }

    .modal-form-label {
        font-family: 'SF Pro';
        font-style: normal;
        font-weight: 590;
        font-size: 11px;
        line-height: 20px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #333333;
        margin-top: 30px;
    }

    .search-members-wrapper {
        width: 100%;
        margin-top: 32px;
    }

    #search-members-input {
        width: 100%;
        background: rgba(77, 89, 151, 0.1);
        border-radius: 40px;
        height: 40px;
        padding: 15px;
        border: none;
    }

    @media screen and (min-width: 1280px) and (max-width: 1400px) {
        .coverPhoto {
            max-height: 267px;
        }
        .assetPrice {
            font-size: 25px;
            font-weight: 500;
        }
    }

    @media screen and (min-width: 1024px) and (max-width: 1279px) {
        .coverPhoto {
            max-height: 200px;
        }
        .assetPrice {
            font-size: 25px;
            font-weight: 500;
        }
    }

    @media screen and (min-width: 800px) and (max-width: 1023px) {
        .coverPhoto {
            max-height: 144px;
        }
        .assetPrice {
            font-size: 25px;
            font-weight: 500;
        }
    }

    @media screen and (max-width: 799px) {
        .coverPhoto {
            max-height: 144px;
        }
        .assetPrice {
            font-size: 25px;
            font-weight: 500;
        }
    }

</style>

<!-- add more member  modal  -->
<div class="modal fade share-asset-modal" id="assetReceiverModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header borderNone modalTitle">
                <h5 class="modal-title " id="exampleModalLabel"><span class="receivedAsset">0</span> people have
                    received this asset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-right: 20px;"></button>
            </div>
            <div class="modal-body">
                <div class="assetMemberList">
                </div>
            </div>
            <div class="modal-footer borderNone">
                <button type="button" class="btn btn-primary fillBtnLg addMorePeople">ADD MORE PEOPLE</button>
            </div>
        </div>
    </div>
</div>
<!-- end add more member  modal  -->

<!-- share asset  Modal  -->
<div class="modal fade share-asset-modal" id="shareAssetModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header borderNone modalTitle displayBlock">
                <h5 class="modal-title " id="exampleModalLabel">Add more people</h5>
                <p>Search members to send this asset to.</p>
                <button type="button" class="btn-close crossBtnIcon" data-bs-dismiss="modal" aria-label="Close"
                        style="margin-right: 20px;"></button>
            </div>
            <form action="{{ route('assetShare') }}" method="post" id="assetShareForm">
                @csrf
                <input name="asset_id" type="hidden" id="asset_id">
                <div class="modal-body">
                    <div class="modalCardArea">
                        <span class="assetCategory"></span>
                        <h6 class="assetName"></h6>
                        <p class="assetDescription"></p>
                        <div class="userInfoBar">
                            <div class="calanderBar">
                                <svg class="calenderSvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                              <path d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"/></svg>
                                <span class="checkInDatetime"></span></div>
                            <div class="addressBar">
                                <span>
                                    <svg id="addressSvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="395.71px" height="395.71px" viewBox="0 0 395.71 395.71" style="enable-background:new 0 0 395.71 395.71;"
                                         xml:space="preserve">
                                            <g>
                                                <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738
                                                    c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388
                                                    C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191
                                                    c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"/>
                                            </g>

                                            </svg>
                                </span>
                                <span class="assetVenueAddress"></span></div>
                        </div>
                    </div>
                    <div class="share-asset-message">
                    <div class="share-aasset-message">
                            <div class="col-sm-12 validationNeed">
                                <label class="mt-4 required font-sf-pro">MESSAGE</label>
                                <textarea class="form-control font-loto" style="height: 120px !important;" rows="4"
                                          name="share_asset_message" id="share_asset_message"></textarea>
                            </div>
                        <div class="searchBY">
                            <div>
                                <label>Share by</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input checkShare" type="radio" name="shareOption" id="members" value="members" checked>
                                <label class="form-check-label" for="members">Members</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input checkShare" type="radio" name="shareOption" id="groups" value="groups">
                                <label class="form-check-label" for="groups">Groups</label>
                            </div>
                        </div>
                    </div>

                    <div class="member_list">
                            <div class="col-sm-12 validationNeed">
                                <select name="member_ids[]" id="member_ids"  multiple>
                                </select>
                                <span class="error_members text-danger"></span>
                            </div>
                        </div>
                    <div class="group_list d-none">
                            <div class="col-sm-12 validationNeed">
                                <select name="group_ids[]" id="group_ids" multiple>
                                </select>
                                <span class="error_groups text-danger"></span>
                            </div>
                        </div>
                </div>
                    <div class="modal-footer borderNone shareAssetBtnGroup">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary fillBtnLg sendAsset">SEND ASSET</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- end share asset  Modal  -->

<div class="d-flex align-items-center justify-content-end">
    <a href="javaScript:void(0)" class="btn btn-link shareBtn mb-3" asset="{{ $asset->id }}">
        Share
    </a>
    <div class="dropdown ps-4 me-0 mb-3">
        <p class="mb-0 mt-1 actionMenu" data-bs-toggle="dropdown" aria-expanded="false"><i
                style="color:#4D5997 !important; font-size: 20px !important;cursor: pointer;"
                class="fa fa-ellipsis-v"></i>
        </p>
        <ul class="dropdown-menu" style="color:#4D5997 !important">
            <li><a href="{{ route('assets_edit', $asset->id) }}"
                   class="dropdown-item d-flex align-items-center font-loto"><i data-feather="user"></i><span
                        class="ms-1 text-default">
                        Edit </span></a></li>
            <li><a href="{{route('assets_preview',['category'=> $asset->asset_category['description'],'id'=>$asset->id])}}"
                   class="dropdown-item d-flex align-items-center font-loto"><i data-feather="user"></i><span
                        class="ms-1 text-default">
                        Preview asset </span></a></li>
            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sendPaymentLinkModal"
                   class="dropdown-item d-flex align-items-center font-loto"><i data-feather="user"></i><span
                        class="ms-1 text-default">
                        Send payment link </span></a></li>
            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                   class="dropdown-item d-flex align-items-center font-loto"><i data-feather="user"></i><span
                        class="ms-1 text-red">
                        Delete Asset</span></a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <div>
            <p class="font-sf-pro assetDetailsCategory">{{$asset->asset_category['description']}}</p>
            <h1 class="assetDetailsName">{{ $asset->name }}</h1>
            <h6 class="mb-4 assetDetailsAddress font-loto">{{$asset->venue_address}}</h6>
            <p class="assetDetailsPriceTitle pt-3">COST DETAILS</p>
            <h1 class="assetPrice"> {{ $asset->asset_cost['cost_details']}}</h1>
            <p class="assetDescription font-loto mb-3">{!! $asset->description !!}</p>
        </div>
    </div>

    <div class="col-md-4">
        @if(count($asset->asset_images)>0)
            <img class="w-100 h-100 img-rounded coverPhoto" src="{{$asset->asset_images[0]->image_url}}" alt="PHOTO">
        @else
            <img class="w-100 h-100 img-rounded coverPhoto" src="{{ asset("assets/images/no-preview.jpg")}}" alt="PHOTO">
        @endif
    </div>
</div>
<div class="assetShareMembers">
    <div class="imageList">
        @if($totalMemberWithAssetShare > 0)
            @for( $i = 0; $i<3 && $i < $totalMemberWithAssetShare; $i++)
            <img class="shareUser shareUser-{{ $i }}"
                 src="{{ ( $assetReceiverList->has($i) && $assetReceiverList[$i]->member->image_url) ? $assetReceiverList[$i]->member->image_url : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__340.png' }}"
                 alt="" >
            @endfor
        @endif
        @if($totalMemberWithAssetShare >3)
        <span class="countMember  shareUser-4">+{{ $totalMemberWithAssetShare - 3  }}</span>
        @endif
    </div>
    <div class="totalMembers">
     <a href="javascript:void(0)">{{ $totalMemberWithAssetShare }} people</a><span>  have received this asset</span>
    </div>
</div>
<hr>
<div class="justify-content-between">
    <div class="row">
        <div class="col-md-4">
            <p class="assetDetailsDateTitle">DATE</p>
            <h5 class="assetDetailsDate">{{ convertDateWithDayName($asset->check_in_datetime) }}
            </h5>
        </div>
        <div class="col-md-4">
            <p class="assetDetailsTimeTitle">TIME</p>
            @if($asset->asset_category['id'] == App\ModelsExtended\AssetCategory::Accommodation)
                <p class="assetDetailsTime"> ---</p>
            @elseif($asset->asset_category['id'] == App\ModelsExtended\AssetCategory::Miscellaneous)
                <p class="assetDetailsTime"> ---</p>
            @else
                <p class="assetDetailsTime"> {{ convertDateTOTime($asset->check_in_datetime) }}</p>
            @endif
        </div>
        <div class="col-md-4">
            <p class="assetDetailsPartySizeTitle"> PARTY SIZE</p>
            @if($asset->asset_category['id'] == App\ModelsExtended\AssetCategory::Accommodation)
                <h5 class="assetDetailsPartySize d-flex">
                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                              clip-rule="evenodd"/>
                    </svg>
                    {{$asset->asset_accommodation_info['number_of_guest'] ? $asset->asset_accommodation_info['number_of_guest']:0}}
                </h5>
            @elseif($asset->asset_category['id'] == App\ModelsExtended\AssetCategory::Dining)
                <h5 class="assetDetailsPartySize d-flex">
                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                              clip-rule="evenodd"/>
                    </svg>
                    {{$asset->asset_dining_info['number_of_guest'] ? $asset->asset_dining_info['number_of_guest'] :0}}
                </h5>
            @elseif($asset->asset_category['id'] == App\ModelsExtended\AssetCategory::Event)
                <h5 class="assetDetailsPartySize d-flex">
                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                              clip-rule="evenodd"/>
                    </svg>
                    {{$asset->asset_event_info['number_of_seats'] ? $asset->asset_event_info['number_of_seats'] :0}}
                </h5>
            @elseif($asset->asset_category['id'] == App\ModelsExtended\AssetCategory::Miscellaneous)
                <h5 class="assetDetailsPartySize d-flex">
                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                              clip-rule="evenodd"/>
                    </svg>
                    {{$asset->asset_miscellaneous_info['number_of_seats'] ? $asset->asset_miscellaneous_info['number_of_seats'] :0}}
                </h5>
            @endif
        </div>
    </div>
</div>
<hr>

<div class="d-flex flex-column w-100">
    <p class="assetDetailsTagsTitle">Tags</p>
    <div class="">
        @foreach($asset->asset_tags as $tag)
            <span class="assetDetailsTags badge badge-purple">{{$tag->description}}</span>
        @endforeach
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-4">
                <h5>Are you sure about to delete this asset?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{ route('assets_delete', $asset->id) }}" class="delete-btn btn-link shareBtn">Delete</a>
                <button type="button" class="close-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sendPaymentLinkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="modal-title-info">Send payment link</h1>
                <p class="modal-description">
                    Send payment link to buyer via Stripe. The buyer will receive an unique link where they can proceed and make they payment for this asset.
                </p>
                <div class="modal-detail-content-container">
                    <div class="modal-main-info-wrapper">
                        <div class="modal-main-info-wrapper-left">
                            <p class="font-sf-pro assetDetailsCategoryModal">{{$asset->asset_category['description']}}</p>
                            <h1 class="assetDetailsNameModal">{{ $asset->name }}</h1>
                        </div>
                        <div class="modal-main-info-wrapper-right">
                            <p class="font-sf-pro assetDetailsCostLabelModal">Price</p>
                            <h1 class="font-sf-pro assetPriceModal"> {{ $asset->asset_cost['cost_details']}}</h1>
                        </div>
                    </div>
                    <p class="modal-description-detail">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet.
                    </p>
                    <div class="d-flex align-items-center asset-detail-modal">
                        <span class="d-flex align-items-center" id="assetUserInfoModal">
                            <img class="modal-icon" src="{{asset('assets/images/user.svg')}}" alt="" data-original-title="" title="">
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
                        <span class="font-loto" id="assetDateTimeModal">
                            <img class="modal-icon" src="{{asset('assets/images/calendar.svg')}}" alt="" data-original-title="" title="">
                            {{ convertDateForAsset($asset->check_in_datetime) }}
                        </span>
                        <span class="px-2">|</span>
                        <span class="font-loto" id="assetAddressModal">
                            <img class="modal-icon" src="{{asset('assets/images/map-pin.svg')}}" alt="" data-original-title="" title="">
                            {{ $asset->venue_address }}
                        </span>
                    </div>
                </div>
                <h5 class="modal-form-label">Message</h5>
                <textarea name="message" id="message-input" rows="5"></textarea>
                <div class="search-members-wrapper">
                    <input type="text" placeholder="Searh members" id="search-members-input">
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel-modal-btn" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('assets_send_payment_link', $asset->id) }}" class="send-payment-link-btn">Send payment link</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#member_ids").select2({
            placeholder: "Search members",
            allowClear: true,
            dropdownParent: $("#shareAssetModal")
        });
        $("#group_ids").select2({
            placeholder: "Search group",
            allowClear: true,
            dropdownParent: $("#shareAssetModal")
        });
    });



</script>
