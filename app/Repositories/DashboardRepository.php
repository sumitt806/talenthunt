<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\FavouriteCompany;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardRepository
 * @package App\Repositories
 * @version July 7, 2020, 5:07 am UTC
 */
class DashboardRepository
{
    /**
     * @return mixed
     */
    public function getDashboardAssociatedData()
    {
        $data['totalUsers'] = User::count();
        $data['totalCandidates'] = User::whereOwnerType(Candidate::class)->count();
        $data['totalEmployers'] = User::whereOwnerType(Company::class)->count();
        $data['totalActiveJobs'] = Job::whereStatus(1)->without(['country', 'state', 'city'])->count();
        $data['totalVerifiedUsers'] = User::whereNotNull('is_verified')->count();
        $data['todayJobs'] = Job::without(['country', 'state', 'city'])->whereDate('created_at',
            Carbon::today())->count();
        $data['featuredJobs'] = Job::without(['country', 'state', 'city'])->has('activeFeatured')->count();
        $data['featuredEmployers'] = Company::has('activeFeatured')->count();
        $data['featuredJobsIncomes'] = Transaction::whereOwnerType(Job::class)->sum('amount');
        $data['featuredCompanysIncomes'] = Transaction::whereOwnerType(Company::class)->sum('amount');
        $data['subscriptionIncomes'] = Transaction::whereOwnerType(Subscription::class)->sum('amount');

        return $data;
    }

    /**
     * @return mixed
     */
    public function getRegisteredCandidatesData()
    {
        return Candidate::with('user')->orderByDesc('created_at')->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getRegisteredEmployersData()
    {
        return Company::with('user')->orderByDesc('created_at')->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getRecentJobsData()
    {
        return Job::with(['company', 'jobCategory', 'jobType', 'jobShift'])->orderBy('created_at',
            'desc')->limit(5)->get();
    }

    /**
     * @return mixed
     */
    public function getEmployerDashboardData()
    {
        $user = Auth::user();
        $jobIds = Job::whereCompanyId($user->owner_id)->pluck('id');
        $data['jobApplicationsCount'] = JobApplication::whereIn('job_id', $jobIds)->count();
        $data['totalJobs'] = sizeof($jobIds);
        $data['pausedJobCount'] = Job::whereCompanyId($user->owner_id)->where('status', Job::STATUS_PAUSED)->count();
        $data['closedJobCount'] = Job::whereCompanyId($user->owner_id)->where('status', Job::STATUS_CLOSED)->count();
        $data['jobCount'] = Job::whereCompanyId($user->owner_id)->where('status', Job::STATUS_OPEN)->count();
        $data['followersCount'] = FavouriteCompany::whereCompanyId($user->owner_id)->count();

        return $data;
    }

    /**
     *
     * @return Job[]|Builder[]|Collection
     */
    public function getEmployerRecentJobsData()
    {
        $user = Auth::user();
        $jobs = Job::whereCompanyId($user->owner_id)->orderByDesc('created_at')->limit(5)->get();

        return $jobs;
    }

    /**
     *
     * @return Builder[]|Collection
     */
    public function getEmployerRecentFollowerData()
    {
        $user = Auth::user();
        $followers = FavouriteCompany::with('user')->where('company_id',
            $user->owner_id)->orderByDesc('created_at')->limit(5)->get();

        return $followers;
    }
}
