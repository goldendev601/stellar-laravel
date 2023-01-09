<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{route('/')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo_light.svg')}}"
                    alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo_dark.svg')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{route('/')}}"><img class="img-fluid"
                    src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="{{route('/')}}"><img class="img-fluid"
                                src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    {{--					<li class="sidebar-main-title">--}}
                    {{--						<div>--}}
                    {{--							<h6 class="lan-1">{{ trans('lang.General') }} </h6>--}}
                    {{--                     		<p class="lan-2">{{ trans('lang.Dashboards,widgets & layout.') }}</p>--}}
                    {{--						</div>--}}
                    {{--					</li>--}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/dashboard' ? 'active' : '' }}"
                            href="{{ route('index') }}"><i data-feather="grid"></i><span
                                class="lan-3">{{ trans('lang.Dashboards') }}</span>
                            {{--							<div class="according-menu"><i class="fa fa-angle-right"></i></div>--}}
                        </a>
                    </li>
                    <li class="sidebar-list"><a
                            class="sidebar-link sidebar-title {{request()->route()->getPrefix().'/conversations' == ' /conversations ' ? 'active' : '' }}"
                            href="{{ route('conversations_index') }}">
                            <i data-feather="message-circle"></i>
                            <span class="lan-6">{{ trans('lang.Conversations') }}</span>
                            {{--<div class="according-menu"><i class="fa fa-angle-right"></i></div>--}}
                        </a>
                        {{--                        <ul class="sidebar-submenu" style="display: none;">--}}
                        {{--                            <li><a href="{{ route('conversations_index') }}">{{ trans('lang.Library') }}</a>
                    </li>--}}
                    {{--                            <!-- <li><a href="{{ route('create_library') }}">{{ trans('lang.Create Library') }}</a>
                    </li> -->--}}
                    {{--                        </ul>--}}
                    </li>

                    @if(auth()->user()->role_id == App\ModelsExtended\Role::Super_Admin)
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/users' ? 'active' : '' }}"
                            href="{{ route('users') }}"><i data-feather="users"></i><span
                                class="lan-3">{{ trans('lang.Administrators') }}</span>
                            {{--							<div class="according-menu"><i class="fa fa-angle-right"></i></div>--}}
                        </a>
                    </li>
                    @endif
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/members' ? 'active' : '' }}"
                            href="{{ route('members') }}"><i data-feather="users"></i><span
                                class="lan-3">{{ trans('lang.Members') }}</span>
                            {{--							<div class="according-menu"><i class="fa fa-angle-right"></i></div>--}}
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title {{request()->route()->getPrefix() == '/assets' ? 'active' : '' }}"
                            href="{{ route('assets_index') }}">
                            <i data-feather="shopping-cart"></i><span class="lan-3">{{ trans('lang.Assets') }}</span>
                        </a>
                    </li>
                    <li class="sidebar-list"><a
                            class="sidebar-link sidebar-title {{request()->route()->getPrefix().'/library' == ' /library ' ? 'active' : '' }}"
                            href="{{ route('library_index') }}">
                            <i data-feather="archive"></i>
                            <span class="lan-6">{{ trans('lang.Library') }}</span>
                            {{-- <div class="according-menu"><i class="fa fa-angle-right"></i></div>--}}
                        </a>
                        {{--                        <ul class="sidebar-submenu" style="display: none;">--}}
                        {{--                            <li><a href="{{ route('library_index') }}">{{ trans('lang.Library') }}</a>
                    </li>--}}
                    {{--                            <!-- <li><a href="{{ route('create_library') }}">{{ trans('lang.Create Library') }}</a>
                    </li> -->--}}
                    {{--                        </ul>--}}
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
