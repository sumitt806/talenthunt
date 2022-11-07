<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Models\Job;
use App\Models\JobApplication;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class JobApplicationRepository
 */
class JobApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'job_id',
        'resume_id',
        'expected_salary',
        'notes',
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
        return JobApplication::class;
    }

    /**
     * @param  int  $jobId
     * @param  int  $candidateId
     * @param  int  $status
     *
     * @return mixed
     */
    public function checkJobStatus($jobId, $candidateId, $status)
    {
        return JobApplication::where('job_id', $jobId)
            ->where('candidate_id', $candidateId)
            ->where('status', $status)
            ->exists();
    }

    /**
     * @param  int  $jobId
     *
     * @return mixed
     */
    public function showApplyJobForm($jobId)
    {
        /** @var Candidate $candidate */
        $candidate = Candidate::findOrFail(Auth::user()->owner_id);

        /** @var Job $job */
        $job = Job::whereJobId($jobId)->first();
        $data['isActive'] = ($job->status == Job::STATUS_OPEN) ? true : false;

        $jobRepo = app(JobRepository::class);
        $data['isApplied'] = $this->checkJobStatus($job->id, $candidate->id, JobApplication::STATUS_APPLIED);

        $data['resumes'] = [];
        $data['isJobDrafted'] = false;
        if (! $data['isApplied']) {
            // get candidate resumes
            $data['resumes'] = $candidate->getMedia('resumes')->pluck('name', 'id');

            // check job is drafted or not
            $data['isJobDrafted'] = $this->checkJobStatus($job->id, $candidate->id, JobApplication::STATUS_DRAFT);

            if ($data['isJobDrafted']) {
                $data['draftJobDetails'] = $job->appliedJobs()->where('candidate_id', $candidate->id)->first();
            }
        }
        $data['job'] = $job;

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            $input['candidate_id'] = Auth::user()->owner_id;

            $job = Job::findOrFail($input['job_id']);
            if ($job->status != Job::STATUS_OPEN) {
                throw new UnprocessableEntityHttpException('job is not active.');
            }

            /** @var JobApplication $jobApplication */
            $jobApplication = JobApplication::where('job_id', $input['job_id'])
                ->where('candidate_id', $input['candidate_id'])
                ->first();

            if ($jobApplication && $jobApplication->status == JobApplication::STATUS_APPLIED) {
                throw new UnprocessableEntityHttpException('You have already applied for this job.');
            }

            if ($jobApplication && $jobApplication->status == JobApplication::STATUS_DRAFT) {
                $jobApplication->delete();
            }

            $input['candidate_id'] = Auth::user()->owner_id;
            $input['expected_salary'] = removeCommaFromNumbers($input['expected_salary']);
            $input['status'] = $input['application_type'] == 'apply' ? JobApplication::STATUS_APPLIED : JobApplication::STATUS_DRAFT;

            $this->create($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
