<!-- =============== Start of Header 1 Navigation =============== -->
<header class="sticky">
    <nav class="navbar navbar-default navbar-static-top fluid_header centered container-shadow">
        <div class="container">

            <!-- Logo -->
            <div class="col-md-2 col-sm-6 col-xs-8 nopadding">
                <a class="navbar-brand nomargin" href="{{url('/')}}">
                    <img src="{{ asset($settings['logo']) }}" alt="logo">
                </a>
                <!-- INSERT YOUR LOGO HERE -->
            </div>

            <!-- ======== Start of Main Menu ======== -->
            <div class="col-md-10 col-sm-6 col-xs-4 nopadding">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle toggle-menu menu-right push-body" data-toggle="collapse"
                            data-target="#main-nav" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Start of Main Nav -->
                <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="main-nav">
                    <ul class="nav navbar-nav pull-right">
                        <!-- Mobile Menu Title -->
                        <li class="mobile-title">
                            <h4>main menu</h4></li>
                        <li class="simple-menu {{ Request::is('/') ? 'active' : '' }}">
                            <a href="{{ route('front.home') }}" class="j-nav-item">{{ __('web.home') }}</a>
                        </li>
                        <li class="simple-menu {{ Request::is('search-jobs') ? 'active' : '' }}">
                            <a href="{{ route('front.search.jobs') }}" class="j-nav-item">{{ __('web.jobs') }}</a>
                        </li>
                        <li class="simple-menu {{ Request::is('company-lists') ? 'active' : '' }}">
                            <a href="{{ route('front.company.lists') }}"
                               class="j-nav-item">{{ __('web.companies') }}</a>
                        </li>
                        <li class="simple-menu {{ Request::is('candidate-lists') ? 'active' : '' }}">
                            <a href="{{ route('front.candidate.lists') }}"
                               class="j-nav-item">{{ __('web.job_seekers') }}</a>
                        </li>
                        <li class="simple-menu {{ Request::is('about-us') ? 'active' : '' }}">
                            <a href="{{ route('front.about.us') }}" class="j-nav-item">{{ __('web.about_us') }}</a>
                        </li>
                        <li class="simple-menu {{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ route('front.contact') }}" class="j-nav-item">{{ __('web.contact_us') }}</a>
                        </li>
                        <li class="simple-menu {{ Request::is('posts') ? 'active' : '' }}">
                            <a href="{{ route('front.post.lists') }}"
                               class="j-nav-item">{{ __('messages.post.blog') }}</a>
                        </li>
                        @auth
                            <li class="dropdown simple-menu">
                                <a href="#" class="dropdown-toggle user-avatar" data-toggle="dropdown" role="button">
                                    <img src="{{ getLoggedInUser()->avatar }}"
                                         class="thumbnail-rounded front-thumbnail"/>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="userName"><span>{{ getLoggedInUser()->full_name }}</span></li>
                                    <li class="userMenu">
                                        <a href="{{ dashboardURL() }}">{{ __('web.go_to_dashboard') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('logout') }}"
                                           onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                            {{ __('web.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                              class="d-none">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="simple-menu {{ Request::is('front-register') ? 'active' : '' }}">
                                <a href="{{ route('front.register') }}" class="j-nav-item"> {{ __('web.register') }}</a>
                            </li>
                            <li class="simple-menu">
                                <a href="{{ route('login') }}" class="btn btn-purple btn-effect"><i
                                            class="fa fa-lock"></i> {{ __('web.login') }}</a>
                            </li>
                        @endauth
                    </ul>
                </div>
                <!-- End of Main Nav -->
            </div>
            <!-- ======== End of Main Menu ======== -->

        </div>
    </nav>
</header>
<!-- =============== End of Header 1 Navigation =============== -->
