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
<h3>Assets</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Assets</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="mb-4 ">
        <h3 class="fw-bold">Create asset</h3>
    </div>
	<div class="row">
		<div class="xl-100 box-col-12">
			<div class="card o-hidden">

				<div class="card-body">
                    <div>
                        <p>TYPE</p>
                        <div class="btn-group container-fluid p-0">
                            <button class="btn btn-primary active border py-3 rounded text-capitalize fs-6">Accommodation</button>
                            <button type="button" class="btn border py-3 rounded text-capitalize fs-6">Dining</button>
                            <button type="button" class="btn border py-3 rounded text-capitalize fs-6">Event</button>
                            <button type="button" class="btn border py-3 rounded text-capitalize fs-6">Event Package</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                            <label for="name" class="mt-4">ASSET NAME:</label>
                            <input type="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">VENUE NAME:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">VENUE ADDRESS:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">SELLER:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">STATUS:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">COST:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">DATE:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">DEADLINE:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                            <div class="col-sm-6 ">
                                <label for="name" class="mt-4">EVENT TIMEZONE:</label>
                                <input type="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            <label class="mt-4">DESCRIPTION:</label>
                                <textarea class="form-control" style="height: 90px !important;" rows="4" id="name"></textarea>
                            </div>
                        </div>
                    </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
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
@endsection
