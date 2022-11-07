<!-- =============== Start of Footer 1 =============== -->
<footer class="footer1">

    <!-- ===== Start of Footer Information & Links Section ===== -->
    <div class="footer-info ptb80">
        <div class="container">

            <!-- 1st Footer Column -->
            <div class="col-md-4 col-sm-12 col-xs-12 footer-about">

                <!-- Your Logo Here -->
                <a href="{{ route('front.home') }}">
                    <img src="{{ asset($settings['logo']) }}" alt="">
                    <span class="app-name">{{ $settings['application_name'] }}</span>
                </a>

                <!-- Small Description -->
                <p class="pt40">{{ $settings['company_description'] }}</p>

                <!-- Info -->
                <ul class="nopadding">
                    <li><i class="fa fa-map-marker"></i>{{$settings['address'] }}</li>
                    <li><i class="fa fa-phone"></i>{{ $settings['phone'] }}</li>
                    <li><i class="fa fa-envelope-o"></i>{{ $settings['email'] }}</li>
                </ul>
            </div>

            <!-- 2nd Footer Column -->
            <div class="col-md-4 col-sm-12 col-xs-12 footer-links footer-spacer">
                <h3>{{ __('web.footer.useful_links') }}</h3>

                <!-- Links -->
                <ul class="nopadding">
                    <li><a href="{{ url('/') }}"><i class="fa fa-angle-double-right"></i>{{ __('web.home') }}</a></li>
                    <li><a href="{{ route('front.search.jobs') }}"><i
                                    class="fa fa-angle-double-right"></i>{{ __('web.jobs') }}</a></li>
                    <li><a href="{{ route('front.company.lists') }}"><i
                                    class="fa fa-angle-double-right"></i>{{ __('web.companies') }}</a></li>
                    <li><a href="{{ route('front.candidate.lists')}}"><i
                                    class="fa fa-angle-double-right"></i>{{ __('web.job_seekers') }}</a></li>
                    <li><a href="{{ route('front.about.us') }}"><i
                                    class="fa fa-angle-double-right"></i>{{ __('web.about_us') }}</a></li>
                    <li><a href="{{ route('front.contact') }}"><i
                                    class="fa fa-angle-double-right"></i>{{ __('web.contact_us') }}</a></li>
                    <li><a href="{{ route('front.post.lists') }}"><i
                                    class="fa fa-angle-double-right"></i>{{ __('messages.post.post') }}</a></li>
                    @if(!getLoggedInUser())
                        <li><a href="{{ route('front.register') }}"><i
                                        class="fa fa-angle-double-right"></i>{{ __('web.register') }}</a></li>
                    @endif
                </ul>
            </div>

            <!-- 4th Footer Column -->
            <div class="col-md-4 col-sm-12 col-xs-12 footer-newsletter footer-spacer">
                <h3>{{ __('web.footer.newsletter') }}</h3>
                <p>{{ __('web.footer.newsletter_text') }}</p>

                <!-- Subscribe Form -->
                <form id="newsLetterForm" class="form-inline mailchimp mtb30">

                    <!-- Form -->
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" id="mc-email" placeholder="Your Email"
                                   autocomplete="off" required>
                            <label for="mc-email"></label>
                            <button type="submit" class="btn btn-orange btn-effect" id="btnLetterSave"
                                    data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">{{ __('web.common.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- ===== End of Footer Information & Links Section ===== -->


    <!-- ===== Start of Footer Copyright Section ===== -->
    <div class="copyright ptb40">
        <div class="container">

            <div class="col-md-6 col-sm-6 col-xs-12">
                <span>{{ __('web.footer.copyright') }} &copy; <a href="//www.infyom.com/" class="text-blue">{{ $settings['application_name'] }}.</a> {{ __('web.footer.all_rights_reserved') }}</span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- Start of Social Media Buttons -->
                <ul class="social-btns list-inline text-right">
                    <!-- Social Media -->
                    @if(!empty($settings['facebook_url']))
                        <li>
                            <a href="{{ $settings['facebook_url'] }}" class="social-btn-roll facebook"
                               target="_blank">
                                <div class="social-btn-roll-icons">
                                    <i class="social-btn-roll-icon fa fa-facebook"></i>
                                    <i class="social-btn-roll-icon fa fa-facebook"></i>
                                </div>
                            </a>
                        </li>
                    @endif
                <!-- Social Media -->
                    @if(!empty($settings['twitter_url']))
                        <li>
                            <a href="{{ $settings['twitter_url'] }}" class="social-btn-roll twitter" target="_blank">
                                <div class="social-btn-roll-icons">
                                    <i class="social-btn-roll-icon fa fa-twitter"></i>
                                    <i class="social-btn-roll-icon fa fa-twitter"></i>
                                </div>
                            </a>
                        </li>
                    @endif
                <!-- Social Media -->
                    @if(!empty($settings['google_plus_url']))
                        <li>
                            <a href="{{ $settings['google_plus_url'] }}" class="social-btn-roll google-plus"
                               target="_blank">
                                <div class="social-btn-roll-icons">
                                    <i class="social-btn-roll-icon fa fa-google-plus"></i>
                                    <i class="social-btn-roll-icon fa fa-google-plus"></i>
                                </div>
                            </a>
                        </li>
                    @endif

                <!-- Social Media -->
                    @if(!empty($settings['linkedIn_url']))
                        <li>
                            <a href="{{ $settings['linkedIn_url']}}" class="social-btn-roll linkedin"
                               target="_blank">
                                <div class="social-btn-roll-icons">
                                    <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                    <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- End of Social Media Buttons -->
            </div>

        </div>
    </div>
    <!-- ===== End of Footer Copyright Section ===== -->

</footer>
<!-- =============== End of Footer 1 =============== -->

<!-- ===== Start of Back to Top Button ===== -->
<a href="#" class="back-top"><i class="fa fa-chevron-up"></i></a>
<!-- ===== End of Back to Top Button ===== -->

<!-- ===== Start of Login Pop Up div ===== -->
<div class="cd-user-modal">
    <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container">
        <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Sign in</a></li>
            <li><a href="#1">New account</a></li>
        </ul>

        <div id="cd-login">
            <!-- log in form -->
            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signin-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="signin-email" type="email"
                           placeholder="E-mail">
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-password" for="signin-password">Password</label>
                    <input class="full-width has-padding has-border" id="signin-password" type="password"
                           placeholder="Password">
                </p>
                <p class="fieldset">
                    <input type="checkbox" id="remember-me" checked>
                    <label for="remember-me">Remember me</label>
                </p>
                <p class="fieldset">
                    <button type="submit" value="Login" class="btn btn-purple btn-effect">Login</button>
                </p>
            </form>
        </div>
        <!-- cd-login -->

        <div id="cd-signup">
            <!-- sign up form -->
            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-username">Username</label>
                    <input class="full-width has-padding has-border" id="signup-username" type="text"
                           placeholder="Username">
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="signup-email" type="email"
                           placeholder="E-mail">
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password">Password</label>
                    <input class="full-width has-padding has-border" id="signup-password" type="password"
                           placeholder="Password">
                </p>
                <p class="fieldset">
                    <input type="checkbox" id="accept-terms">
                    <label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
                </p>
                <p class="fieldset">
                    <button class="btn btn-purple btn-effect" type="submit" value="Create account">Create Account</button>
                </p>
            </form>
        </div>
        <!-- cd-signup -->
    </div>
    <!-- cd-user-modal-container -->
</div>
<!-- cd-user-modal -->
<!-- ===== End of Login Pop Up div ===== -->
