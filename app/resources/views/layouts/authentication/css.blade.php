<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">
<!-- Default css -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/default.css')}}">
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
<!-- Plugins css start-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<!-- Preview pages css start-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/preview.css')}}">
<style>
    body {
        background: linear-gradient(167.96deg, #090F28 0%, #0F2D47 46.87%, #85797C 80.21%, #DFB2A4 96.08%);
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    .login-card .login-main {
        width: 368px;
        padding: 48px 40px;
    }
    .form-group {
        margin-bottom: 16px !important;
    }
    .form-group label {
        margin-bottom: 8px;
        font-size: 14px;
        line-height: 21px;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
    }
    .form-group input {
        padding: 12px 20px !important;
        border-radius: 40px;
        border: 1px solid #DEDDE6 !important;
        font-size: 14px;
        line-height: 21px;
        background: #fff !important;
    }
    .form-group input::placeholder {
        color: #949499;
    }
    .btn {
        border-radius: 40px !important;
        padding: 8px 16px !important;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        font-size: 12px;
        line-height: 21px;
        font-weight: 600;
    }
    .btn-primary {
        background: #4D5997 !important;
        border-color: #4D5997 !important;
    }
    .btn-light {
        color: #313131;
        border-color: #C6C5CC !important;
        background: white !important;
    }
    .btn-showcase {
        text-align: left;
    }
    .login-btn {
        margin-top: 32px;
    }
    .text-primary {
        color: #0F2D47 !important;
        font-weight: 600;
    }
    .text-gray {
        color: #636266 !important;
        font-weight: 600;
    }
    .checkbox label:before {
        color: #0F2D47 !important;
        border: 1px solid #0F2D47 !important;
    }
    .login-card .login-main .theme-form .or:before {
        background-color: #DEDDE6;
    }
    .mt-4 {
        margin-top: 2rem !important;
    }
</style>
<style>
#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: auto;
    background-color: #fff;
    color: #000;
    text-align: center;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
    padding: 20px 40px;
    border-radius: 10px;
    -webkit-box-shadow: 0 0 37px rgb(8 21 66 / 5%);
    box-shadow: 0 0 37px rgb(8 21 66 / 5%);
    transform: translateX(-50%);
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
</style>
@yield('css')
<!-- Plugins css Ends-->