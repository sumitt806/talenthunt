@extends('web.layouts.app')
@section('title')
    {{ __('web.home') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/web-popular-categories.css') }}">
@endsection
@section('content')
    <!-- ===== Start of Main Search Section ===== -->
    <section class="main overlay-black">
        <!-- Start of Wrapper -->
        <div class="container wrapper">
            <h1 class="capitalize text-center text-white"> {{ __('web.home_menu.your_career_starts_now') }}</h1>

            <!-- Start of Form -->
            <form class="job-search-form row pt40" action="{{ route('front.search.jobs') }}" method="get">

                <!-- Start of keywords input -->
                <div class="col-md-3 col-sm-12 search-keywords">
                    <label for="search-keywords">{{ __('web.home_menu.keywords') }}</label>
                    <input type="text" name="keywords" id="search-keywords" placeholder="Keywords">
                </div>

                <!-- Start of category input -->
                <div class="col-md-3 col-sm-12 search-categories">
                    <label for="search-categories">{{ __('web.home_menu.any_category') }}</label>
                    <select name="categories" class="selectpicker" id="search-categories" data-live-search="true"
                            title="Any Category" data-size="5" data-container="body">
                        @foreach($jobCategories as $key => $jobCategory)
                            <option value="{{ $key }}">{{ $jobCategory }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Start of location input -->
                <div class="col-md-4 col-sm-12 search-location">
                    <label for="search-location">{{ __('web.common.location') }}</label>
                    <input type="text" name="location" id="search-location" placeholder="Location">
                </div>

                <!-- Start of submit input -->
                <div class="col-md-2 col-sm-12 search-submit">
                    <button type="submit" class="btn btn-purple btn-effect btn-large"><i
                                class="fa fa-search"></i>{{ __('web.common.search') }}
                    </button>
                </div>

            </form>
            <!-- End of Form -->

            <div class="extra-info pt20">
                <span class="text-left text-white"><b>{{ $dataCounts['jobs'] }}</b> {{ __('web.home_menu.jobs_offers_for') }} <b> {{ __('web.home_menu.you') }}.</b></span>
            </div>

        </div>
        <!-- End of Wrapper -->
    </section>
    <!-- ===== End of Main Search Section ===== -->

    <!-- ===== Start of Popular Categories Section ===== -->
    <section class="ptb40 bg-gray" id="categories">
        <div class="container">
            <div class="section-title">
                <h2>{{ __('web.home_menu.popular_categories') }}</h2>
            </div>
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-3 {{ ($loop->last && $loop->iteration > 4) ? 'col-md-offset-4' : '' }} mt30">
                        <div class="top-categories">
                            <div align="center">
                                <h4 class="category-name"><a
                                            href="{{ route('front.search.jobs',array('categories'=> $category->id)) }}">
                                        {{ $category->name }}
                                    </a></h4>
                                <br>
                            </div>
                            <div class="job-count">
                                <h5 class="text-center">{{ $category->jobs_count }}
                                    &nbsp; {{ ($category->jobs_count == 0) ? __('web.home_menu.position_open') :  __('web.home_menu.positions_open')}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===== End of Popular Categories Section ===== -->

    <!-- ===== Start of Job Post Section ===== -->
    <section class="ptb80 bg-gray" id="job-post">
        <div class="container">
            <!-- Start of Job Post Main -->
            <div class="col-md-12 col-sm-12 col-xs-12 job-post-main">
                <h2 class="capitalize"><i class="fa fa-briefcase"></i>{{ __('web.home_menu.latest_jobs') }}</h2>

                <!-- Start of Job Post Wrapper -->
                <div class="job-post-wrapper mt40">
                    <div class="row">
                        @if(count($latestJobs) > 0)
                            @foreach($latestJobs as $job)
                                @include('web.common.job_card')
                            @endforeach
                            <div class="col-md-12 text-center">
                                <a href="{{ route('front.search.jobs') }}"
                                   class="btn btn-purple btn-effect mt50">{{ __('web.common.browse_all') }}</a>
                            </div>
                        @else
                            <div class="related-job-not-found">
                                <h5 class="text-center">{{ __('web.home_menu.latest_job_not_available') }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End of Job Post Wrapper -->
            </div>
            <!-- End of Job Post Main -->
        </div>
    </section>
    <!-- ===== End of Job Post Section ===== -->

    <!-- ===== Start of Job Post Section ===== -->
    <section class="pb80 bg-gray" id="job-post">
        <div class="container">
            <!-- Start of Job Post Main -->
            <div class="col-md-12 col-sm-12 col-xs-12 job-post-main">
                <h2 class="capitalize"><i class="fa fa-briefcase"></i>{{ __('web.home_menu.featured_jobs') }}</h2>

                <!-- Start of Job Post Wrapper -->
                <div class="job-post-wrapper mt40">
                    <div class="row">
                        @if(count($featuredJobs) > 0)
                            @foreach($featuredJobs as $job)
                                @include('web.common.job_card')
                            @endforeach
                        @else
                            <div class="related-job-not-found">
                                <h5 class="text-center">{{ __('web.home_menu.latest_job_not_available') }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End of Job Post Wrapper -->
            </div>
            <!-- End of Job Post Main -->
        </div>
    </section>
    <!-- ===== End of Job Post Section ===== -->

    <!-- ===== Start of Featured Companies Section ===== -->
    <section class="pt40 pb80 bg-gray" id="job-post">
        <div class="container">
            <!-- Start of Job Post Main -->
            <div class="col-md-12 col-sm-12 col-xs-12 job-post-main">
                <h2 class="capitalize"><i class="fa fa-briefcase"></i>{{ __('web.home_menu.featured_companies') }}</h2>

                <!-- Start of Job Post Wrapper -->
                <div class="job-post-wrapper mt40">
                    <div class="row">
                        @if(count($featuredCompanies) > 0)
                            @foreach($featuredCompanies as $company)
                                @include('web.common.company_card')
                            @endforeach
                            <div class="col-md-12 text-center">
                                <a href="{{ route('front.company.lists',['is_featured' => true]) }}"
                                   class="btn btn-purple btn-effect mt50">{{ __('web.common.browse_all') }}</a>
                            </div>
                        @else
                            <div class="related-job-not-found">
                                <h5 class="text-center">{{ __('web.home_menu.featured_companies_not_available') }}</h5>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- End of Job Post Wrapper -->
            </div>
            <!-- End of Job Post Main -->
        </div>
    </section>
    <!-- ===== End of Featured Companies Section ===== -->

    <!-- ===== Start of CountUp Section ===== -->
    <section class="ptb40 bg-gray" id="countup">
        <div class="container">
            <!-- 1st Count up item -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['candidates'] }}"></span>
                <h4>{{ __('messages.front_home.candidates') }}</h4>
            </div>

            <!-- 2nd Count up item -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['jobs'] }}"></span>
                <h4>{{ __('messages.front_home.jobs') }}</h4>
            </div>

            <!-- 3rd Count up item -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['resumes'] }}"></span>
                <h4>{{ __('messages.front_home.resumes') }}</h4>
            </div>

            <!-- 4th Count up item -->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <span class="counter text-purple" data-from="0" data-to="{{ $dataCounts['companies'] }}"></span>
                <h4>{{ __('messages.front_home.companies') }}</h4>
            </div>
        </div>
    </section>
    <!-- ===== End of CountUp Section ===== -->

    <!-- ===== Start of Testimonial Section ===== -->
    @if(count($testimonials) > 0)
        @include('web.home.testimonials')
    @endif
    <!-- ===== End of Testimonial Section ===== -->

    <!-- ===== Start of Notices Section ===== -->
    @if(count($notices) > 0)
        @include('web.home.notices')
    @endif
    {{--    {{  getCountries()  }}--}}
    <!-- ===== End of Notices Section ===== -->
@endsection
@section('page_scripts')
    <script>
        $('.selectpicker').selectpicker({
            dropupAuto: false,
        });
        var availableLocation = [];
        @foreach(getCountries() as $county)
        availableLocation.push("{{ $county  }}");
        @endforeach


        $('#search-location').autocomplete({
            source: availableLocation,
        });
    </script>
@endsection

