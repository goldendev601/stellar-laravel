<?php
/** @var \App\ModelsExtended\Member $member */
/** @var \App\ModelsExtended\MemberStatus[] $statuses */
?>
<?php $default_image = asset('assets/images/user.jpg'); ?>
@extends('layouts.simple.master')

@section('title', 'Members')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/member.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Members</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Members</li>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center pb-3">
                <h1>Members</h1>
                <div class="add-new-member-btn"><a href="{{ route('members.add') }}"> <i data-feather="plus"></i>Add
                        new
                        member</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row memberPage">
        <div class="xl-100 box-col-12">
            <div class="card o-hidden">
                <div class="card-body p-0">
                    <div class="row mt-2">
                        <div class="col-md-3 border-end p-0">
                            <form name="searchForm" method="get" action="{{ url('/members') }}">
                                <div class="d-flex align-items-center justify-content-between leftSideSecrchBox">
                                    <input class="search-input-field" type="text" placeholder="Search member"
                                        name="search" value="{{ request('search') }}"
                                        onkeyup="submitFormOnEnter(document.searchForm, event)" />
                                    <div class="dropdown p-0 me-0">
                                        <svg class="filter-icon" data-bs-toggle="dropdown" aria-expanded="false"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                        </svg>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)" onclick="document.searchForm.submit()"
                                                    class="dropdown-item d-flex align-items-center"><span
                                                        class="ms-1 text-default">All</span></a>
                                                <input type="text" value="" style="display:none">
                                            </li>
                                            @foreach ($statuses as $status)
                                            @if (request('member_status_id') == $status->id)
                                            <li><a href="javascript:void(0)" onclick="document.searchForm.submit()"
                                                    class="dropdown-item d-flex align-items-center"><span
                                                        class="ms-1 text-default">{{ $status->description }}</span></a>
                                                <input type="text" value="{{ $status->id }}" style="display:none">
                                            </li>
                                            @else
                                            <li><a href="javascript:void(0)" onclick="document.searchForm.submit()"
                                                    class="dropdown-item d-flex align-items-center"><span
                                                        class="ms-1 text-default">{{ $status->description }}</span></a>
                                                <input type="text" value="{{ $status->id }}" style="display:none">
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            <div class="memberList mt-3">
                                <ul>
                                    @if($members->count())
                                    @foreach ($members as $member)
                                    <li id="{{ $member->id }}" class="member"><a href="javascript:void(0)">
                                            @if ($member->image_relative_url)
                                            <img class="img-fluid rounded-circle" src="{{ $member->image_url }}"
                                                alt="{{ $member->first_name }}">
                                            @else
                                            <img class="img-fluid rounded-circle" src="{{ $default_image }}"
                                                alt="Image description">
                                            @endif
                                            <div>
                                                <p class="name text-natural-gray-7 fw-700">
                                                    {{$member->first_name}} {{$member->last_name}}
                                                </p>
                                                <p class="phone text-natural-gray-7 opacity-50">
                                                    {{\App\Http\Controllers\MemberController::formatUSAPhone($member->msisdn)}}
                                                </p>
                                            </div>

                                        </a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div id="memberPageRight" class="col-md-9 py-3 px-5">
                            <div class="loaderWrapper">
                                <img class="img-fluid rounded-circle" src="{{ asset('assets/images/load-data.gif') }}"
                                    alt="Image loader">
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
<script src="{{asset('assets/js/member.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>


<script>
function submitFormOnEnter(form, event) {
    if (event.keyCode === 13) form.submit();
}
setTimeout(function() {
    $('#success-meg').fadeOut('fast');
}, 4000);
</script>
@endsection