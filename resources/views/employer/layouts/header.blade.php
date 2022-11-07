<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar mb-0 pb-0">
    <a href="{{ route('front.home') }}" class="navbar-brand sidebar-gone-hide">{{ config('app.name') }}</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <ul class="navbar-nav navbar-right ml-auto">

        @if(\Illuminate\Support\Facades\Auth::user())
            <li class="dropdown">
                <a href="#" data-toggle="dropdown"
                   class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ getLoggedInUser()->avatar }}"
                         class="rounded-circle mr-1 user-thumbnail">
                    <div class="d-sm-none d-lg-inline-block">
                        {{ __('messages.common.hi') }}, {{\Illuminate\Support\Facades\Auth::user()->first_name}}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">
                        {{ __('messages.common.welcome') }}
                        , {{\Illuminate\Support\Facades\Auth::user()->full_name}}</div>
                    <a class="dropdown-item has-icon editProfileModal" href="#" data-id="{{ getLoggedInUserId() }}">
                        <i class="fa fa-user"></i>{{ __('messages.user.edit_profile') }}</a>
                    <a class="dropdown-item has-icon changePasswordModal" href="#"
                       data-id="{{ getLoggedInUserId() }}"><i
                                class="fa fa-lock"> </i>{{ (Str::limit(__('messages.user.change_password'),20,'...')) }}
                    </a>
                    <a class="dropdown-item has-icon changeLanguageModal" href="#"
                       data-id="{{ getLoggedInUserId() }}"><i
                                class="fa fa-language"> </i>{{ (Str::limit(__('messages.user_language.change_language'),20,'...')) }}
                    </a>
                    <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                       onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{ __('messages.user.logout') }}
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        @else
            <li class="dropdown"><a href="#" data-toggle="dropdown"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
                    <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">{{ __('messages.common.login') }}
                        / {{ __('messages.common.register') }}</div>
                    <a href="{{ route('login') }}" class="dropdown-item has-icon">
                        <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('register') }}" class="dropdown-item has-icon">
                        <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                    </a>
                </div>
            </li>
        @endif
    </ul>
</nav>
<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">

            <li class="nav-item {{ Request::is('employer/dashboard*') ? 'active' : ''}}">
                <a href="{{ route('employer.dashboard') }}" class="nav-link"><i
                            class="fab fa-dashcube"></i><span>{{ __('messages.dashboard') }}</span></a>
            </li>
            <li class="nav-item {{ Request::is('employer/jobs*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('job.index') }}">
                    <i class="fas fa-briefcase"></i><span>{{ __('messages.employer_menu.jobs') }}</span></a>
            </li>
            <li class="nav-item {{ Request::is('employer/company*') ? 'active' : ''}}">
                <a class="nav-link"
                   href="{{ route('company.edit.form', \Illuminate\Support\Facades\Auth::user()->owner_id) }}">
                    <i class="far fa-user-circle"></i>
                    <span>{{ __('messages.employer_menu.employer_profile') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('employer/followers*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('followers.index') }}">
                    <i class="fab fa-foursquare"></i>
                    <span>{{ __('messages.employer_menu.followers') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('employer/manage-subscriptions*') ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('manage-subscription.index') }}">
                    <i class="fa fa-dollar-sign dollar-sign-icon"></i>
                    <span>{{ __('messages.employer_menu.manage_subscriptions') }}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
