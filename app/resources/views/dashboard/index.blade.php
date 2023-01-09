@extends('layouts.simple.master')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-6 col-lg-12 xl-50 morning-sec box-col-12">
            <div class="card o-hidden profile-greeting">
                <div class="card-body">
                    <div class="media">
                        <div class="badge-groups w-100">
                            <div class="ms-auto badge f-12"><i class="me-1" data-feather="clock"></i><span
                                    id="txt"></span></div>
                        </div>
                    </div>
                    <div class="greeting-user">
                        <h4 class="f-w-700 text-default">Welcome back, {{Auth::user() ? Auth::user()->name : 'Emay Walter' }}</h4>
                        <p class="text-natural-gray-6">Here's what's happening in your account today.</p>
                        <div class="whatsnew-btn"><a class="btn btn-primary">See What's new</a></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 xl-50 appointment-sec box-col-12">
            <div class="row">
                <div class="col-xl-12 appointment">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="header-top">
                                <h5 class="m-0 text-default">Members</h5>
{{--                                <div class="card-header-right-icon">--}}
{{--                                    <select class="button btn btn-primary">--}}
{{--                                        <option>Today</option>--}}
{{--                                        <option>Tomorrow</option>--}}
{{--                                        <option>Yesterday</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="appointment-table table-responsive">
                                <table class="table table-bordernone">
                                    <tbody>
                                    @if(@$members)
                                    @foreach($members as $member)

                                        <tr>
                                            <td>
                                                <img class="img-fluid img-40 rounded-circle mb-4"
                                                    src="{{ $member['image_url'] != null  ? $member['image_url']  : asset('assets/images/appointment/app-ent.jpg') }}"
                                                    alt="Image description">
                                                <div class="status-circle bg-primary"></div>
                                            </td>
                                            <td class="img-content-box">
                                                <div class="d-flex justify-content-between">
                                                    <span class="text-natural-gray-7 appointment-name">{{ $member['name'] }}</span>
                                                    <span class="text-default message-time">{{ $member['status_time'] }}</span>
                                                </div>
                                                <p class="text-natural-gray-6 message-content f-w-700">{{ $member['body'] }} </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>
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
<script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
<script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/default.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<!-- <script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script> -->
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>

<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script>
@if($message = session('logiggedin-success'))
swal("{{ $message }}");
@endif
</script>
@endsection
