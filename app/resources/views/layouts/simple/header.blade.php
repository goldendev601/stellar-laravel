<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="mb-3 w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div>
                        <i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="{{route('/')}}"><img class="img-fluid"
                        src="{{asset('assets/images/logo.svg')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                <!-- <li>
                    <div class="mode"><i class="fa fa-envelope-o"></i></div>
                </li> -->
                <!-- <li class="onhover-dropdown">
                    <div class="notification-box"><i data-feather="bell"> </i><span
                            class="badge rounded-pill badge-secondary">4 </span></div>
                    <ul class="notification-dropdown onhover-show-div">
                        <li>
                            <i data-feather="bell"></i>
                            <h6 class="f-18 mb-0">Notitications</h6>
                        </li>
                        <li><a class="btn btn-primary" href="#">Check all notification</a></li>
                    </ul>
                </li> -->
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <!-- <li><span class="header-search"><i data-feather="search"></i></span></li> -->
                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="media profile-media">
                        <img class="profile-img-header" src="{{!empty(Auth::user()->image_url) ? Auth::user()->image_url : asset('assets/images/dashboard/profile.jpg')}}" alt="">
                        <div class="media-body">
                            <span>{{Auth::user() ? Auth::user()->name : 'Emay Walter' }}</span>
                            <p class="mb-0 font-roboto">{{ Auth::user()->role ? Auth::user()->role->description : ''}} <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="/account"><i data-feather="user"></i><span>Account </span></a></li>
                        <!-- <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                        <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li> -->
                        <li><a href="/settings"><i data-feather="settings"></i><span>Settings</span></a></li>
                        <li><a href="/logout"><i data-feather="log-in"> </i><span>Log Out</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName">@{{name}}</div>
      </div>
      </div>
    </script>
        <script class="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
        </script>
    </div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    @yield('breadcrumb-title')
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('/') }}"> <i data-feather="home"></i></a></li>
                        @yield('breadcrumb-items')
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
