@extends('web.layouts.app')
@section('title')
    {{ __('messages.candidate.candidate_details') }}
@endsection
@section('content')
    <!-- ===== Start of Candidate Profile Header Section ===== -->
    <section class="profile-header">
    </section>
    <section class="pb80 work-education bg-gray" id="candidate-profile">
        <div class="container">
            <div class="row candidate-profile">

                <div class="col-md-3 col-xs-12">
                    <div class="profile-photo ticket-sender-picture">
                        <img src="{{ $candidateDetails->user->avatar }}" class="img-responsive" alt="">
                    </div>

                    <ul class="social-btns list-inline text-center mt20">

                        @if(! empty($candidateDetails->user->facebook_url))
                            <li>
                                <a href="{{ (isset($candidateDetails->user->facebook_url)) ? $candidateDetails->user->facebook_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll facebook transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                        <i class="social-btn-roll-icon fa fa-facebook"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(! empty($candidateDetails->user->twitter_url))
                            <li>
                                <a href="{{ (isset($candidateDetails->user->twitter_url)) ? $candidateDetails->user->twitter_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll twitter transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                        <i class="social-btn-roll-icon fa fa-twitter"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(! empty($candidateDetails->user->google_plus_url))
                            <li>
                                <a href="{{ (isset($candidateDetails->user->google_plus_url)) ? $candidateDetails->user->google_plus_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll google-plus transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-google-plus"></i>
                                        <i class="social-btn-roll-icon fa fa-google-plus"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(! empty($candidateDetails->user->pinterest_url))
                            <li>
                                <a href="{{ (isset($candidateDetails->user->pinterest_url)) ? $candidateDetails->user->pinterest_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll pinterest transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                        <i class="social-btn-roll-icon fa fa-pinterest"></i>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if(! empty($candidateDetails->user->linkedin_url))
                            <li>
                                <a href="{{ (isset($candidateDetails->user->linkedin_url)) ? $candidateDetails->user->linkedin_url : 'javascript:void(0)' }}"
                                   class="social-btn-roll linkedin transparent" target="_blank">
                                    <div class="social-btn-roll-icons">
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                        <i class="social-btn-roll-icon fa fa-linkedin"></i>
                                    </div>
                                </a>
                            </li>
                            @endif
                    </ul>
                    @auth
                        @role('Employer')
                        <div class="row">
                            <div class="col-md-offset-12 col-md-6 reportJobBtn">
                                <div class="company-report-web company-web clearfix">
                                    <button class="mt15 btn btn-small btn-red btn-effect reportToCompany reportToCandidate {{ ($isReportedToCandidate) ? 'disabled' : '' }}"
                                            data-toggle="modal"
                                            data-target="#reportToCandiateModal">
                                        {{ __('messages.candidate.reporte_to_candidate') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endrole
                    @endauth

                </div>


                <div class="col-md-9 col-xs-12">
                    <div class="profile-descr">

                        <div class="profile-title">
                            <h2 class="capitalize">{{ $candidateDetails->user->full_name }}</h2>
                            <h5 class="pt10">{{ $candidateDetails->functionalArea->name ?? ''  }}</h5>
                        </div>
                        <ul class="profile-info mt20 nopadding">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                @if(!empty($candidateDetails->user->country_name))
                                    <span>{{ $candidateDetails->user->country_name }}, {{ $candidateDetails->user->state_name }}, {{ $candidateDetails->user->city_name }},</span>
                                @else
                                    <span>N/A</span>
                                @endif
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <a href="#">{{ $candidateDetails->user->email }}</a>
                            </li>
                            <li>
                                <i class="fa fa-birthday-cake"></i>
                                <span>{{ date('jS M, Y', strtotime($candidateDetails->user->dob)) }}</span>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <span>{{ isset($candidateDetails->user->phone) ? $candidateDetails->user->phone : __('messages.candidate_dashboard.no_not_available')}}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="job-header mt30 box-shadow">
                <div class="contentbox">
                    <h3>{{ __('messages.skills') }}</h3>
                    <div class="row skillbar">
                        @if($candidateDetails->user->candidateSkill->count())
                            @foreach($candidateDetails->user->candidateSkill as $candidateSkill)
                                <div class="col-md-6 col-xs-12 mt20">
                                    <div class="skillbar-title">
                                        <span>{{ $candidateSkill->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h6 class="text-center">No skills.</h6>
                        @endif
                    </div>
                </div>
            </div>

            <div class="job-header mt30 box-shadow">
                <div class="contentbox">
                    <h3>{{ __('messages.candidate_profile.education') }}</h3>
                    <ul class="educationList">
                        @forelse($candidateEducations as $candidateEducation)
                            <li>
                                <div class="date">{{ $candidateEducation->year }}</div>
                                <h4>{{$candidateEducation->degreeLevel->name}}</h4>
                                @if(!empty($candidateEducation->country_name))
                                    <label class="text-muted">
                                        <i class="fa fa-map-marker"></i> {{ $candidateEducation->country_name }}
                                    </label>
                                @endif
                                <div class="row">
                                    <div class="col-md-4 nopadding-left">
                                    <span class="text-muted font-weight-bolder">
                                            {{ __('messages.candidate_profile.institute').' : '.$candidateEducation->institute}}
                                    </span>
                                    </div>
                                    <div class="col-md-4 nopadding-left">
                                    <span class="text-muted font-weight-bolder">
                                        {{ __('messages.candidate_profile.result').' : '.$candidateEducation->result}}
                                    </span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <h6 class="text-center">{{ __('messages.candidate.education_not_found') }}</h6>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="job-header mt30 box-shadow">
                <div class="contentbox">
                    <h3>{{ __('messages.candidate.experience') }}</h3>
                    <ul class="experienceList">
                        @forelse($candidateExperiences as $candidateExperience)
                            <li>
                                <div class="date">
                                    {{ \Carbon\Carbon::parse($candidateExperience->start_date)->format('Y') }}
                                    <br>-<br>
                                    {{($candidateExperience->currently_working) ? 'present' : \Carbon\Carbon::parse($candidateExperience->end_date)->format('Y') }}
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4>{{$candidateExperience->company}}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if(!empty($candidateExperience->country_name))
                                                    <label class="text-muted">
                                                        <i class="fa fa-map-marker"></i>
                                                        {{ $candidateExperience->country_name }}
                                                    </label>
                                                @endif
                                            </div>
                                        </div>
                                        @if(!empty($candidateExperience->description))
                                            <p class="text-muted"
                                               data-toggle="tooltip">{!! nl2br($candidateExperience->description) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @empty
                            <h6 class="text-center">{{ __('messages.candidate.experience_not_found') }}</h6>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @role('Employer')
    @include('web.candidate.report_to_candidate_modal')
    @endrole

@endsection
@section('scripts')
    <script>
        let reportToCandidateUrl = "{{ route('report.to.candidate') }}";
    </script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ mix('assets/js/candidate/front/candidate-details.js') }}"></script>
@endsection

