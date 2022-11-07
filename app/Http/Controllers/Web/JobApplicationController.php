<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ApplyJobRequest;
use App\Models\Job;
use App\Repositories\JobApplicationRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class JobApplicationController extends AppBaseController
{
    /** @var  JobApplicationRepository */
    private $jobApplicationRepository;

    public function __construct(JobApplicationRepository $jobApplicationRepo)
    {
        $this->jobApplicationRepository = $jobApplicationRepo;
    }

    /**
     * @param  string  $jobId
     *
     * @return Factory|View
     */
    public function showApplyJobForm($jobId)
    {
        $data = $this->jobApplicationRepository->showApplyJobForm($jobId);

        if (sizeof($data['resumes']) <= 0) {
            return redirect()->back()->with('warning', 'There are no resume uploaded.');
        }

        return view('web.jobs.apply_job.apply_job')->with($data);
    }

    /**
     * @param  ApplyJobRequest  $request
     *
     * @return mixed
     */
    public function applyJob(ApplyJobRequest $request)
    {
        $input = $request->all();

        $this->jobApplicationRepository->store($input);

        /** @var Job $job */
        $job = Job::findOrFail($input['job_id']);

        return $input['application_type'] == 'draft' ?
            $this->sendResponse($job->job_id, 'Job Application Drafted Successfully') :
            $this->sendResponse($job->job_id, 'Job Applied Successfully');
    }
}
