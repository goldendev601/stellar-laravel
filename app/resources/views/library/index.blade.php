<?php /** @var \App\ModelsExtended\Vendor[]|\Illuminate\Database\Eloquent\Collection $vendors **/?>
@extends('layouts.simple.master')

@section('title', 'Library')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/library.css')}}">
@endsection

@section('style')
    <style>
        .search-supplier {
            position: relative;
        }
        .search-supplier span {
            position: absolute;
            left: 16px;
            color: #4D5997;
            font-size: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .leftSideSecrchBox {
            padding: 20px 13px 20px 26px !important;
        }
        .search-input-field::placeholder{
            color: #4D5997;
            opacity: 0.5;
            font-size: 14px;

        }
        .search-input-field{
            padding: 10px 10px 10px 40px !important;
        }
        .supplierList ul li{
            border-bottom: unset !important;
        }
        .vendor.bg-theme-primary.text-white{
            background: rgba(77, 89, 151, 0.1) !important;
            color: black !important;
        }
        .vendor.bg-theme-secondary.text-black{
        background: transparent !important;
        }
        span.suppliers_count {
            padding-left: 31px;

        }
        .suppliers_count_div {
             color: #4d5997;
        }
        .supplierList {
            height: 564px;
            overflow-y: auto;
            margin-bottom: 0px !important;
        }
        .scroll_style_library::-webkit-scrollbar  {
            width: 1px;
        }

        /* Track */
        .scroll_style_library::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px transparent;
            border-radius: 10px;
        }

        /* Handle */
        .scroll_style_library::-webkit-scrollbar-thumb {
            background: transparent;
            border-radius: 10px;
        }
        #selected {
            height: 564px;
            overflow-y: auto;
            margin-bottom: 0px !important;
        }
        span.vendor_alias {
            font-size: 12px;
        }
    </style>
@endsection

@section('breadcrumb-title')
<h3>Library</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Library </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between pb-3">
                <h1>Library</h1>
                <div class="add-new-supplier-btn"><a href="{{ route('create_library') }}"> <i
                            data-feather="plus"></i>Add
                        new
                        Supplier</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row libraryPage">
        <div class="xl-100 box-col-12">
            <div class="card o-hidden">
                <div class="card-body p-0">
                    <div class="row mt-2">
                        <div class="col-md-3 border-end p-0">
                            <div class=" align-items-center justify-content-between leftSideSecrchBox">
                                <div class="search-supplier">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input class="search-input-field" type="text" placeholder="Search a supplier" />
                                </div>

{{--                                <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">--}}
{{--                                    <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />--}}
{{--                                </svg>--}}
                            </div>
                            <div class="suppliers_count_div ">
                                <span class="suppliers_count">{{ count($vendors) }}</span> suppliers
                            </div>
                            <div class="supplierList scroll_style_library mt-3">

                                <ul>
                                    @if(count($vendors) > 0)
                                    @foreach($vendors as $vendor)
                                    <li class="vendor" id="{{ $vendor->id }}"><a href="javascript:void(0)" >
                                            <img class="img-fluid rounded-circle"
                                                src="{{$vendor->logo->image_url ?? asset('assets/images/user/12.png')}}" width="120px">
                                            <div>
                                                <p class="name text-natural-gray-7 fw-700">{{ $vendor->name }}</p>
                                                <p class="type text-natural-gray-7 opacity-50">{{ $vendor->type }}</p>
                                                <span class="vendor_alias ">({{ $vendor->alias }})</span>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div id="selected" class="col-md-9 py-3 px-5 scroll_style_library">
                            <div class="d-flex align-items-center justify-content-end">
                                <a href="{{ route('library_edit',($vendors->first()) ? $vendors->first()->id : '') }}"
                                    class="btn btn-link  px-4 py-2 me-3 rounded-10px text-decoration-none editSupplierBtn">
                                    Edit Supplier
                                </a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </div>
                            <div class="d-flex flex-column w-100 mt-4">
                                <div class="rowSupplierProfile pt-2">
                                    <div class="column">
                                        <div class="photo-column">
                                            <img class="img-fluid rounded-circle"
                                                src="{{$vendors->first()->logo->image_url ?? asset('assets/images/image-8.png')}}" alt="Image description">
                                        </div>
                                    </div>
                                    <div class='double-column'>
                                        <div class='details-column'>
                                            <h4 class="text-natural-gray-7 mb-2">{{ @$vendors->first()->name }}</h4>
                                            <span class="text-natural-gray-7 opacity-50">{{ @$vendors->first()->type }}</span>
                                            <p class="mt-1">{{ @$vendors->first()->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row general-info mt-5">
                                    <h3 class="title text-natural-gray-7 opacity-50 fw-700 mb-3">GENERAL INFO
                                    </h3>
                                    <div class="col-sm-6">
                                        <div>
                                            <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Email</p>
                                            <p class="email fw-700">{{ @$vendors->first()->email }}</p>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Address</p>
                                            <p class="text-natural-gray-7 opacity-50 fw-400">{{ @$vendors->first()->address }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>
                                            <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Website</p>
                                            <p class="text-natural-gray-7 opacity-50 fw-400">{{ @$vendors->first()->website }}</p>
                                        </div>
                                        <div class="mt-3">
                                            <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Added on</p>
                                            <p class="text-natural-gray-7 opacity-50 fw-400">
                                                {{ ($vendors->first()) ? $vendors->first()->created_at->toDayDateTimeString() : '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex flex-column w-100">
                                <p class="text-tags text-natural-gray-7 fw-700 opacity-50">TAGS</p>
                                <div class="pt-2">
                                    <?php
                                        $tags = explode(',', @$vendors->first()->tags)
                                    ?>
                                    @foreach($tags as $tag)
                                    <span class="badge badge-purple mb-2">{{ $tag }}</span>
                                     @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex flex-column w-100 mt-4 supplierPhoto">
                                <p class="text-photos text-natural-gray-7 fw-700 opacity-50">PHOTOS</p>
                                <div class="row pt-2 text-center">
                                    @if( ($vendors->first()) ? $vendors->first()->images->count() : '')
                                        @foreach($vendors->first()->images as $image)
                                            <div class="col-sm-3">
                                                <img class="img-fluid" src="{{$image->image_url ?? asset('assets/images/image-8.png')}}"
                                                     alt="Image description">
                                            </div>
                                        @endforeach
                                    @endif
                                    {{--<div class="col-sm-3">
                                        <img class="img-fluid" src="{{asset('assets/images/image-8.png')}}"
                                            alt="Image description">
                                    </div>
                                    <div class="col-sm-3">
                                        <img class="img-fluid" src="{{asset('assets/images/image-9.png')}}"
                                            alt="Image description">
                                    </div>
                                    <div class="col-sm-3">
                                        <img class="img-fluid" src="{{asset('assets/images/image-8.png')}}"
                                            alt="Image description">
                                    </div>
                                    <div class="col-sm-3">
                                        <img class="img-fluid" src="{{asset('assets/images/image-8.png')}}"
                                            alt="Image description">
                                    </div>--}}
                                </div>
                            </div>
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
<script src="{{asset('assets/js/library.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data.js"></script>
    <script>

        $(document).ready(function(){
            $(".search-input-field").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".supplierList ul li").filter(function() {
                    $(this).toggle($(this).find('.name').text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

@endsection
