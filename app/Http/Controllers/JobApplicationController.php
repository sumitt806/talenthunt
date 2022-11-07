<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Queries\JobApplicationDataTable;
use App\Repositories\JobApplicationRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class JobApplicationController extends AppBaseController
{
    /** @var  JobApplicationRepository */
    private $jobApplicationRepository;

    public function __construct(JobApplicationRepository $jobApplicationRepo)
    {
        $this->jobApplicationRepository = $jobApplicationRepo;
    }

    /**
     * Display a listing of the Industry.
     *
     * @param  int  $jobId
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index($jobId, Request $request)
    {
        $input['job_id'] = $jobId;
        $job = Job::with('city')->findOrFail($jobId);
        if ($request->ajax()) {
            return Datatables::of((new JobApplicationDataTable())->get($input))->make(true);
        }
        $statusArray = JobApplication::STATUS;

        return view('employer.job_applications.index', compact('jobId', 'statusArray', 'job'));
    }


    /**
     * Remove the specified Job Application from storage.
     *
     * @param  JobApplication  $jobApplication
     *
     * @throws Exception
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(JobApplication $jobApplication)
    {
        $this->jobApplicationRepository->delete($jobApplication->id);

        return $this->sendSuccess('Job Application deleted successfully.');
    }

    /**
     * @param  $id
     *
     * @param $status
     *
     * @return mixed
     */
    public function changeJobApplicationStatus($id, $status)
    {
        $jobApplication = JobApplication::findOrFail($id);
        if (! in_array($jobApplication->status, [JobApplication::REJECTED, JobApplication::COMPLETE])) {
            $jobApplication->update(['status' => $status]);

            return $this->sendSuccess('Status changed successfully.');
        }

        return $this->sendError(JobApplication::STATUS[$jobApplication->status].' job cannot be '.JobApplication::STATUS[$status]);
    }
}
