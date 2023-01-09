<?php $default_image = asset('assets/images/user.jpg'); ?>
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
<div class="d-flex align-items-center justify-content-end">
    <a href="{{ route('members.edit', $member->id) }}"
        class="btn btn-link  px-4 py-2 me-3 rounded-10px text-decoration-none editContactBtn">
        Edit Contact
    </a>

    <div class="dropdown p-0 me-0">
        <p class="mb-0 text-end" data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="more-vertical"></i>
        </p>
        <ul class="dropdown-menu">
            <li><a href="{{ route('members.edit', $member->id) }}" class="dropdown-item d-flex align-items-center"><i
                        data-feather="user"></i><span class="ms-1 text-default">Edit
                        Profile </span></a></li>
            <li><a href="#" class="dropdown-item d-flex align-items-center"><i data-feather="tag"></i><span
                        class="ms-1 text-default">View
                        and Tag
                        Contact</span></a></li>
            <li><a href="#" class="dropdown-item d-flex align-items-center"><i data-feather="box"></i><span
                        class="ms-1 text-default">Create
                        Asset</span></a></li>
            <li><a href="#" class="dropdown-item d-flex align-items-center"><i data-feather="message-square"></i><span
                        class="ms-1 text-default">View
                        Conversation</span></a>
            </li>
            <li><a href="#" class="dropdown-item d-flex align-items-center"><i data-feather="database"> </i><span
                        class="ms-1 text-default">View/Add Seller
                        Configuration</span></a></li>
        </ul>
    </div>
</div>
<div class="d-flex flex-column w-100 mt-4">
    <div class="rowMemberProfile pt-2">
        <div class="column">
            <div class="photo-column">
                @if ($member->image_relative_url)
                <img class="img-fluid rounded-circle" src="{{ $member->image_url }}" alt="{{ $member->first_name }}">
                @else
                <img class="img-fluid rounded-circle" src="{{ $default_image }}" alt="Image description">
                @endif
            </div>
        </div>
        <div class='double-column'>
            <div class='details-column'>
                <h4 class="text-natural-gray-7 mb-2">{{ $member->first_name }} {{ $member->last_name }}</h4>
                <span
                    class="text-natural-gray-7 opacity-50">{{\App\Http\Controllers\MemberController::formatUSAPhone($member->msisdn)}}</span>
                <p class="text-natural-gray-7 opacity-50 mt-1">{{ $member->email }}</p>
            </div>
        </div>
    </div>
    <div class="row general-info mt-5">
        <h3 class="title text-natural-gray-7 opacity-50 fw-700 mb-3">GENERAL INFO
        </h3>
        <div class="col-sm-6">
            <div>
                <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Email</p>
                <p class="email fw-700">{{ $member->email }}</p>
            </div>
            <div class="mt-3">
                <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Address</p>
                <p class="text-natural-gray-7 opacity-50 fw-400">
                    static address</p>
            </div>
        </div>
        <div class="col-sm-6">
            <div>
                <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Phone</p>
                <p class="text-natural-gray-7 opacity-50 fw-400">
                    {{\App\Http\Controllers\MemberController::formatUSAPhone($member->msisdn)}}</p>
            </div>
            <div class="mt-3">
                <p class="text-natural-gray-7 opacity-50 fw-700 mb-0">Added on</p>
                <p class="text-natural-gray-7 opacity-50 fw-400">
                    {{$member->created_at}}</p>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="d-flex flex-column w-100 interest">
    <p class="subSectionTitle text-natural-gray-7 fw-700 opacity-50">INTERESTS</p>
    <div class="pt-2">
        @if(count($member->member_interests)>0)
        @foreach ($member->member_interests as $interest)
        <span class="badge badge-purple mb-2">{{$interest->interest}}</span>
        @endforeach
        @endif
    </div>
</div>
<hr>
<div class="d-flex flex-column w-100">
    <p class="subSectionTitle text-natural-gray-7 fw-700 opacity-50">ASSSETS</p>
    <p class="subSectionTitle text-natural-gray-7 fw-700 opacity-50 mt-5">Restaurant</p>
    <div class="restaurantDetails">
        <h4>Eleven Madison Park</h4>
        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet,
            consectetur
            adipiscing
            elit.Lorem ipsum dolor sit amet.</p>
        <div class="d-flex flex-row align-items-start text-natural-gray-7 fw-700 opacity-50 mt-3">
            <p class="d-flex align-items-center pr-2"><i data-feather="user"></i><span class="me-1 border-end">2</span>
            </p>
            <p class="d-flex align-items-center pr-2"><i data-feather="calendar"></i><span
                    class="me-1 border-end">2/15/22,
                    8:00PM </span></p>
            <p class="d-flex align-items-center pr-2"><i data-feather="map-pin" class="me-1"></i> New York, NY</p>
        </div>
    </div>
</div>

<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>