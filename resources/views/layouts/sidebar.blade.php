<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <img src="{{ getLogoUrl() }}" width="70px" class="navbar-brand-full"/>&nbsp;&nbsp;
        <a href="{{ url('/') }}">{{ config('app.name') }}</a>
        <div class="input-group px-3">
            <input type="text" class="form-control searchTerm" id="searchText" placeholder="Search Menu"
                   autocomplete="off">
            <div class="input-group-append">
                <div class="input-group-text">
                    <i class="fas fa-search search-sign"></i>
                    <i class="fas fa-times close-sign"></i>
                </div>
            </div>
            <div class="no-results mt-3 ml-1">No matching records found</div>
        </div>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ getLogoUrl() }}" alt="{{config('app.name')}}"/>
        </a>
    </div>
    <ul class="sidebar-menu mt-3">
        <li class="side-menus {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa fa-digital-tachograph"></i>
                <span>{{ __('messages.dashboard') }}</span></a></li>
    </ul>
    <ul class="sidebar-menu">
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-user-tie"></i>
                <span>{{ __('messages.employers') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/companies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('company.index') }}">
                        <i class="fas fa-user-friends"></i>
                        <span>{{ __('messages.employers') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/reported-company*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reported.companies') }}">
                        <i class="fas fa-file-signature"></i>
                        <span> {{ __('messages.company.reported_employers') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-users"></i>
                <span>{{ __('messages.candidates') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/candidates*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('candidates.index') }}">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ __('messages.candidates') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/required-degree-level*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('requiredDegreeLevel.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>{{ __('messages.required_degree_levels') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/reported-candidate*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reported.candidates') }}">
                        <i class="fas fa-file-signature"></i>
                        <span>{{ __('messages.candidate.reported_candidates') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-briefcase"></i>
                <span>{{ __('messages.jobs') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/jobs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.jobs.index') }}">
                        <i class="fas fa-briefcase"></i>
                        <span>{{ __('messages.jobs') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('job-categories.index') }}">
                        <i class="fas fa-sitemap"></i>
                        <span>{{ __('messages.job_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobType.index') }}">
                        <i class="fas fa-list-alt"></i>
                        <span>{{ __('messages.job_types') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-tags*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobTag.index') }}">
                        <i class="fas fa-tags"></i>
                        <span>{{ __('messages.job_tags') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/job-shifts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('jobShift.index') }}">
                        <i class="fas fa-clock"></i>
                        <span>{{ __('messages.job_shifts') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/reported-jobs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('reported.jobs') }}">
                        <i class="fab fa-r-project"></i>
                        <span>{{ __('messages.reported_jobs') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fab fa-usps"></i>
                <span>{{ __('messages.post.blog') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/post-categories*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('post-categories.index') }}">
                        <i class="far fa-list-alt"></i>
                        <span> {{ __('messages.post_category.post_categories') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posts.index') }}">
                        <i class="fas fa-blog"></i>
                        <span> {{ __('messages.post.posts') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item side-menus dropdown">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-solar-panel"></i>
                <span>{{ __('messages.plan.subscriptions') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/plans*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('plans.index') }}">
                        <i class="fab fa-bandcamp"></i>
                        <span>{{ __('messages.subscriptions_plans') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/transactions*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('transactions.index') }}">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>{{ __('messages.transactions') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="side-menus {{ Request::is('admin/subscribers*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('subscribers.index') }}">
                <i class="fas fa-bell"></i>
                <span>{{ __('messages.subscribers') }}</span>
            </a>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-cogs"></i>
                <span>{{ __('messages.general') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/marital-status*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('maritalStatus.index') }}">
                        <i class="fas fa-life-ring"></i>
                        <span>{{ __('messages.marital_statuses') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/skills*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('skills.index') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>{{ __('messages.skills') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/salary-periods*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('salaryPeriod.index') }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ __('messages.salary_periods') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/industries*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('industry.index') }}">
                        <i class="fas fa-landmark"></i>
                        <span>{{ __('messages.industries') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/company-sizes*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('companySize.index') }}">
                        <i class="fas fa-list-ol"></i>
                        <span>{{ __('messages.company_sizes') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/functional-area*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('functionalArea.index') }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>{{ __('messages.functional_areas') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/career-levels*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('careerLevel.index') }}">
                        <i class="fas fa-level-up-alt"></i>
                        <span>{{ __('messages.career_levels') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/salary-currencies*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('salaryCurrency.index') }}">
                        <i class="fas fa-money-bill"></i>
                        <span>{{ __('messages.salary_currencies') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/ownership-types*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ownerShipType.index') }}">
                        <i class="fas fa-universal-access"></i>
                        <span>{{ __('messages.ownership_types') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/languages*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('languages.index') }}">
                        <i class="fas fa-language"></i>
                        <span>{{ __('messages.languages') }}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown side-menus">
            <a class="nav-link has-dropdown" href="#"><i class="fas fa-users-cog"></i>
                <span>{{ __('messages.cms') }}</span>
            </a>
            <ul class="dropdown-menu side-menus">
                <li class="side-menus {{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('testimonials.index') }}">
                        <i class="fas fa-sticky-note"></i>
                        <span>{{ __('messages.testimonials') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/noticeboards*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('noticeboards.index') }}">
                        <i class="fas fa-clipboard"></i>
                        <span>{{ __('messages.noticeboards') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/faqs*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('faqs.index') }}">
                        <i class="fas fa-question-circle"></i>
                        <span> {{ __('messages.faq.faq') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/inquires*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('inquires.index') }}">
                        <i class="fab fa-linkedin"></i>
                        <span> {{ __('messages.inquires') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/front-settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('front.settings.index') }}">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('messages.setting.front_settings') }}</span>
                    </a>
                </li>
                <li class="side-menus {{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('settings.index') }}">
                        <i class="fas fa-sliders-h"></i>
                        <span>{{ __('messages.settings') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ mix('assets/js/sidebar_menu_search/sidebar_menu_search.js') }}"></script>
