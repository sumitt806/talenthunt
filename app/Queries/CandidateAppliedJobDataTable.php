<?php

namespace App\Queries;

use App\Models\JobApplication;

/**
 * Class CandidateAppliedJobDataTable
 */
class CandidateAppliedJobDataTable
{
    /**
     * @return JobApplication
     */
    public function get()
    {
        /** @var JobApplication $query */
        $query = JobApplication::with(['candidate.user', 'job'])->select('job_applications.*')->where('candidate_id',
            getLoggedInUser()->owner_id);

        return $query;
    }
}
