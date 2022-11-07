<?php

namespace App\Queries;

use App\Models\ReportedToCompany;
use App\ReportedToCandidate;

/**
 * Class ReportedCompanyDataTable
 */
class ReportedCandidateDataTable
{
    /**
     * @return ReportedToCompany
     */
    public function get()
    {
        /** @var ReportedToCompany $query */
        $query = ReportedToCandidate::with(['user', 'candidate.user'])->select('reported_to_candidates.*')->get();

        $result = $data = [];
        $query->map(function (ReportedToCandidate $reportedToCandidate) use ($data, &$result) {
            $data['id'] = $reportedToCandidate->id;
            $data['user'] = [
                'full_name'  => $reportedToCandidate->user->full_name,
                'first_name' => $reportedToCandidate->user->first_name,
                'last_name'  => $reportedToCandidate->user->last_name,
            ];
            $data['candidate']['user'] = [
                'full_name'  => $reportedToCandidate->candidate->user->full_name,
                'first_name' => $reportedToCandidate->candidate->user->first_name,
                'last_name'  => $reportedToCandidate->candidate->user->last_name,
            ];
            $data['note'] = $reportedToCandidate->note;
            $data['created_at'] = $reportedToCandidate->created_at->toDateTimeString();

            $result[] = $data;
        });

        return $result;
    }
}
