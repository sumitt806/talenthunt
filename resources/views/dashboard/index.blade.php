@extends('layouts.app')
@section('title')
    {{ __('messages.dashboard') }}
@endsection
@push('css')
    <link href="{{ mix('assets/css/dashboard-widgets.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('messages.dashboard') }}</h1>
        </div>
        <!-- statistics count starts -->
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon total-users-bg">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.total_candidates') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['totalCandidates'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon verified-users-bg">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.total_employers') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['totalEmployers'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon today-jobs-bg">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.total_active_jobs') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['totalActiveJobs'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon feature-jobs-bg">
                        <i class="fab fa-foursquare"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.featured_jobs') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['featuredJobs'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon feature-employers-bg">
                        <i class="fas fa-user-tag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.featured_employers') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['featuredEmployers'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon feature-jobs-incomes-bg">
                        <i class="fas fa-money-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.featured_jobs_incomes') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['featuredJobsIncomes'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon feature-employers-incomes-bg">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.featured_employers_incomes') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['featuredCompanysIncomes'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon subscription-incomes-bg">
                        <i class="fas fa-money-bill"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('messages.admin_dashboard.subscription_incomes') }}</h4>
                        </div>
                        <div class="card-body mt-0">
                            {{ $data['dashboardData']['subscriptionIncomes'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- statistics count ends -->

        <div class="row">
            <!-- recent registered candidates starts -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('messages.admin_dashboard.recent_candidates') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('candidates.index') }}"
                               class="btn btn-info">{{ __('messages.common.view_more') }} <i
                                        class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0 mt-0">
                        <div class="table-responsive table-invoice table-bordered">
                            <table class="table table-striped mb-0">
                                <tbody>
                                <tr class="">
                                    <th>{{ __('messages.common.name') }}</th>
                                    <th>{{ __('messages.candidate.immediate_available') }}</th>
                                    <th>{{ __('messages.candidate.is_verified') }}</th>
                                </tr>
                                @foreach($data['registerCandidatesData'] as $registeredCandidates)
                                    <tr>
                                        <td>
                                            <a href="{{ route('candidates.show', $registeredCandidates->id) }}">{{ $registeredCandidates->user->full_name }}</a>
                                        </td>
                                        <td>
                                            <i class="pl-5 {{ ($registeredCandidates->immediate_available) ? 'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger' }}"></i>
                                        </td>
                                        <td>
                                            <i class="pl-4 {{ ($registeredCandidates->user->is_verified) ? 'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger' }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- recent registered candidates ends -->

            <!-- recent registered employers starts -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('messages.admin_dashboard.recent_employers') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('company.index') }}"
                               class="btn btn-info">{{ __('messages.common.view_more') }} <i
                                        class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0 mt-0">
                        <div class="table-responsive table-invoice table-bordered">
                            <table class="table table-striped mb-0">
                                <tbody>
                                <tr class="">
                                    <th>{{ __('messages.common.name') }}</th>
                                    <th>{{ __('messages.company.website') }}</th>
                                    <th>{{ __('messages.company.location') }}</th>
                                    <th>{{ __('messages.company.is_featured') }}</th>
                                </tr>
                                @foreach($data['registerEmployersData'] as $registeredEmployers)
                                    <tr>
                                        <td>
                                            <a href="{{ route('company.show', $registeredEmployers->id) }}">{{ $registeredEmployers->user->full_name }}</a>
                                        </td>
                                        <td>
                                            @if($registeredEmployers->website !== null)
                                                <a href="{{ 
                                                    (!str_contains($registeredEmployers->website,'https://') 
                                                    ? 'https://'.$registeredEmployers->website
                                                    : $registeredEmployers->website) }}"
                                                   target="_blank">{{ Str::limit($registeredEmployers->website,25,'...') }}</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            {{ $registeredEmployers->location != '' ? $registeredEmployers->location : 'N/A' }}
                                        </td>
                                        <td>
                                            <i class="pl-4 {{ ($registeredEmployers->is_featured) ? 'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger' }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- recent registered employers ends -->
        </div>

        <div class="row">
            <!-- recent jobs starts -->
            <div class="col-lg-12 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('messages.admin_dashboard.recent_jobs') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.jobs.index') }}"
                               class="btn btn-info">{{ __('messages.common.view_more') }} <i
                                        class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0 mt-0">
                        <div class="table-responsive table-invoice table-bordered">
                            <table class="table table-striped mb-0">
                                <tbody>
                                <tr class="">
                                    <th>{{ __('messages.job.job_title') }}</th>
                                    <th>{{ __('messages.company.employer_name') }}</th>
                                    <th>{{ __('messages.job_category.job_category') }}</th>
                                    <th>{{ __('messages.job.job_type') }}</th>
                                    <th>{{ __('messages.job.job_shift') }}</th>
                                    <th>{{ __('messages.job.is_featured') }}</th>
                                </tr>
                                @foreach($data['recentJobsData'] as $recentJobs)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.jobs.show', $recentJobs->id) }}">{{ $recentJobs->job_title }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('company.show', $recentJobs->company_id) }}">{{ $recentJobs->company->user->full_name }}</a>
                                        </td>
                                        <td>{{ $recentJobs->jobCategory->name }}</td>
                                        <td>{{ Str::limit($recentJobs->jobType->name,50,'...') }}</td>
                                        <td>{{ (!empty($recentJobs->jobShift)) ? $recentJobs->jobShift->shift : 'N/A' }}</td>
                                        <td>
                                            <i class="pl-4 {{ ($recentJobs->is_featured) ? 'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger' }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- recent jobs ends -->
        </div>
    </section>
@endsection
