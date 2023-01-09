@extends('layouts.simple.master')

@section('title', 'Conversations')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/conversation.css')}}">
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
@endsection

@section('style')
<style>
.page-wrapper.compact-wrapper .page-body-wrapper .page-body {
    margin-top: 130px !important
}

.page-wrapper .page-header .container-fluid {
    display: none !important
}
.clearfix .other-message{
    max-width: 350px !important;
    width: fit-content !important;
}
.widthAdjust{
    flex: unset !important;
    max-width: 100% !important;
}
.clearfix .my-message{
    max-width: 350px !important;
    width: fit-content !important;
}
.clearfix .my-message-asset{
    max-width: 350px !important;
    width: fit-content !important;
}
.loader-box {
    height: calc(100vh - 147px) !important;
    background: white;
    width: 100% !important;
    position: absolute;
    z-index: 9;

}
div#no-conversation {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.conversationsList{
    height: 405px;
    overflow-y: auto;
}
.lastMsgTime{
    white-space: nowrap !important;
}
.inActive{
    pointer-events: none;
}
button.input-group-text.btn.btn-primary.inActive {
    background: #4d5997a8 !important;
    border: 1px solid #4d5997a8 !important;
}
.activeMember {
    background: #edeef4 !important;
}

.lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 20px;
}
.lds-ellipsis div {
    position: absolute;
    top: 4px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #fff;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}
@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}
@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(24px, 0);
    }
}
.lastMsgTime{
    position: relative;
}
/*.lastMsgTime:before{*/
/*    content:"";*/
/*    width: 4px;*/
/*    height: 4px;*/
/*    border-radius: 100px;*/
/*    position: absolute;*/
/*    left: 37px;*/
/*    top: 5px;*/
/*    background-color: #677281;*/
/*}*/
.dot_time{
    display: block;
    width: 4px;
    height: 4px;
    background-color: #677281;
    border-radius: 100px;
    position: relative;
    top: 1px;

}
.lastMsgTime{
    display: flex;
    align-items: center;
    gap: 4px;
}
p.name.text-natural-gray-7 {
    white-space: nowrap;
    width: 140px;
    overflow: hidden;
    text-overflow: ellipsis;

}
.conversationsList .listTime {
    padding-left: 0px;

}
</style>
@endsection


@section('content')
    <div class="vue-container">

{{--@if($member)--}}
            <App :member_by_id="{{ json_encode($member)}}"></App>
{{--        @else--}}
{{--            <App></App>--}}
{{--        @endif--}}

    </div>

<script type="text/javascript">
var session_layout = '{{ session()->get('
layout ') }}';
</script>
@endsection

@section('script')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/conversation.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.31/moment-timezone-with-data.js"></script>



<script>

function submitFormOnEnter(form, event) {
    if (event.keyCode === 13) form.submit();
}
</script>
@endsection
