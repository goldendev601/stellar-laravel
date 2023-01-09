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
    <h3>List Assets</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Assets</li>
@endsection

@section('content')
    <div class="container-fluid asset-listing">
        <div class="row second-chart-list third-news-update">
            <div class="xl-100 morning-sec box-col-12">
                <div class="card o-hidden">
                    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-primary">
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col" width="35%">Name</th>
                                        <th scope="col" width="35%">Category</th>
                                        <th scope="col" width="20%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($assets as $key => $asset)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$asset->name}}</td>
                                            <td>{{$asset->category->name}}</td>
                                            <td>
                                                <a href="{{ route('assets_edit', $asset->id) }}" class="btn btn-success" type="button">Edit</a>
                                                <a href="{{ route('assets_delete', $asset->id) }}" class="btn btn-danger" type="button">Delete</a>
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
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <script>
        function submitFormOnEnter(form, event) {
            if (event.keyCode === 13) form.submit();
        }
        setTimeout(function() {
            $('#success-meg').fadeOut('fast');
        }, 4000);
    </script>
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
