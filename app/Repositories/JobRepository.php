<?php

namespace App\Repositories;

use App\Mail\EmailJobToFriend;
use App\Models\Candidate;
use App\Models\CareerLevel;
use App\Models\Company;
use App\Models\EmailJob;
use App\Models\FavouriteJob;
use App\Models\FunctionalArea;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use App\Models\JobShift;
use App\Models\JobType;
use App\Models\Plan;
use App\Models\ReportedJob;
use App\Models\RequiredDegreeLevel;
use App\Models\SalaryCurrency;
use App\Models\SalaryPeriod;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PragmaRX\Countries\Package\Countries;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class JobRepository
 * @package App\Repositories
 * @version July 12, 2020, 12:34 pm UTC
 */
class JobRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'job_title',
        'is_freelance',
        'hide_salary',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Job::class;
    }
    
    public function prepareJobData()
    {
        $data['jobTypes'] = JobType::pluck('name', 'id');
        $data['jobCategories'] = JobCategory::pluck('name', 'id');
        $data['jobSkills'] = Skill::pluck('name', 'id');
        $data['genders'] = Job::NO_PREFERENCE;
        $data['careerLevels'] = CareerLevel::pluck('level_name', 'id');
        $data['functionalAreas'] = FunctionalArea::pluck('name', 'id');

        return $data;
    }

    /**
     * @return mixed
     */
    public function prepareData()
    {
        $countries = new Countries();
        $data['jobType'] = JobType::pluck('name', 'id');
        $data['jobCategory'] = JobCategory::pluck('name', 'id');
        $data['careerLevels'] = CareerLevel::pluck('level_name', 'id');
        $data['jobShift'] = JobShift::pluck('shift', 'id');
        $data['currencies'] = SalaryCurrency::pluck('currency_name', 'id');
        $data['salaryPeriods'] = SalaryPeriod::pluck('period', 'id');
        $data['functionalArea'] = FunctionalArea::pluck('name', 'id');
        $data['preference'] = Job::NO_PREFERENCE;
        $data['jobSkill'] = Skill::pluck('name', 'id');
        $data['jobTag'] = Tag::pluck('name', 'id');
        $data['requiredDegreeLevel'] = RequiredDegreeLevel::pluck('name', 'id');
        $data['countries'] = getCountries();
        $data['companies'] = Company::with('user')->get()->pluck('user.full_name', 'id');

        return $data;
    }

    /**
     *
     * @return mixed
     */
    function getUniqueJobId()
    {
        $jobUniqueId = Str::random(12);
        while (true) {
            $isExist = Job::whereJobId($jobUniqueId)->exists();
            if ($isExist) {
                self::getUniqueJobId();
            }
            break;
        }

        return $jobUniqueId;
    }

    /**
     * @param  array  $input
     *
     * @throws \Throwable
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();

            $input['salary_from'] = (double) removeCommaFromNumbers($input['salary_from']);
            $input['salary_to'] = (double) removeCommaFromNumbers($input['salary_to']);
            $input['company_id'] = (isset($input['company_id'])) ? $input['company_id'] : Auth::user()->owner_id;
            $input['job_id'] = $this->getUniqueJobId();
            /** @var Job $job */

            if (isset($input['state_id']) && ! is_numeric($input['state_id'])) {
                $input['state_id'] = null;
            }

            $job = $this->create($input);

            if (isset($input['jobsSkill']) && ! empty($input['jobsSkill'])) {
                $job->jobsSkill()->sync($input['jobsSkill']);
            }
            if (isset($input['jobTag']) && ! empty($input['jobTag'])) {
                $job->jobsTag()->sync($input['jobTag']);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     * @param  Job  $job
     *
     * @throws \Throwable
     * @return bool|Builder|Builder[]|Collection|Model
     */
    public function update($input, $job)
    {
        try {
            DB::beginTransaction();
            $input['salary_from'] = (double) removeCommaFromNumbers($input['salary_from']);
            $input['salary_to'] = (double) removeCommaFromNumbers($input['salary_to']);
            // update Job
            if (isset($input['state_id']) && ! is_numeric($input['state_id'])) {
                $input['state_id'] = null;
            }
            if ($job->status == Job::STATUS_DRAFT) {
                $job->status = Job::STATUS_OPEN;
            }
            $job->update($input);

            if (isset($input['jobsSkill']) && ! empty($input['jobsSkill'])) {
                $job->jobsSkill()->sync($input['jobsSkill']);
            }
            if (isset($input['jobTag']) && ! empty($input['jobTag'])) {
                $job->jobsTag()->sync($input['jobTag']);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  int  $jobId
     *
     * @return mixed
     */
    public function isJobAddedToFavourite($jobId)
    {
        return FavouriteJob::where('user_id', Auth::user()->id)->where('job_id', $jobId)->exists();
    }

    /**
     * @param  int  $jobId
     *
     * @return mixed
     */
    public function isJobReportedAsAbuse($jobId)
    {
        return ReportedJob::where('user_id', Auth::user()->id)->where('job_id', $jobId)->exists();
    }

    /**
     * @param  Job  $job
     *
     * @return mixed
     */
    public function getJobDetails(Job $job)
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Candidate $candidate */
        $candidate = Candidate::findOrFail($user->candidate->id);

        /** @var JobApplicationRepository $jobApplicationRepo */
        $jobApplicationRepo = app(JobApplicationRepository::class);

        // check candidate is already applied for job
        $data['isApplied'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
            JobApplication::STATUS_APPLIED);

        // check job is drafted
        $data['isJobDrafted'] = $data['isJobApplicationRejected'] = $data['isJobApplicationCompleted'] = false;
        if (! $data['isApplied']) {
            // check job is drafted or not
            $data['isJobDrafted'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
                JobApplication::STATUS_DRAFT);

            $data['isJobApplicationRejected'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
                JobApplication::REJECTED);

            $data['isJobApplicationCompleted'] = $jobApplicationRepo->checkJobStatus($job->id, $candidate->id,
                JobApplication::COMPLETE);
        }

        $data['isJobAddedToFavourite'] = $this->isJobAddedToFavourite($job->id);
        $data['isJobReportedAsAbuse'] = $this->isJobReportedAsAbuse($job->id);

        return $data;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function storeFavouriteJobs($input)
    {
        $favouriteJob = FavouriteJob::where('user_id', $input['userId'])->where('job_id', $input['jobId'])->exists();
        if (! $favouriteJob) {
            FavouriteJob::create([
                'user_id' => $input['userId'],
                'job_id'  => $input['jobId'],
            ]);

            return true;
        } else {
            FavouriteJob::where('user_id', $input['userId'])->where('job_id', $input['jobId'])->delete();

            return false;
        }
    }

    /**
     * @param $input
     *
     *
     * @return bool
     */
    public function storeReportJobAbuse($input)
    {
        $jobReportedAsAbuse = ReportedJob::where('user_id', $input['userId'])->where('job_id',
            $input['jobId'])->exists();
        if (! $jobReportedAsAbuse) {
            ReportedJob::create([
                'user_id' => $input['userId'],
                'job_id'  => $input['jobId'],
                'note'    => $input['note'],
            ]);

            return true;
        }

        return false;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function emailJobToFriend($input)
    {
        try {
            DB::beginTransaction();

            /** @var EmailJob $emailJob */
            $emailJob = EmailJob::create($input);
            Mail::to($input['friend_email'])->send(new EmailJobToFriend($emailJob));

            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @throws Exception
     *
     * @return bool
     */
    public function canCreateMoreJobs()
    {
        /** @var Company $company */
        $company = Company::whereUserId(Auth::id())->first();

        /** @var SubscriptionRepository $subscriptionRepo */
        $subscriptionRepo = app(SubscriptionRepository::class);
        // retrieve user's subscription
        $subscription = $subscriptionRepo->getUserSubscription($company->user_id);

        if ($subscription) {
            // retrieve job count
            $jobCount = Job::whereStatus(Job::STATUS_OPEN)->where('company_id', $company->id)->count();

            $maxJobCount = Plan::whereId($subscription->plan_id)->value('allowed_jobs');

            if ($maxJobCount > $jobCount) {
                return true;
            }
        }

        return false;
    }
}
