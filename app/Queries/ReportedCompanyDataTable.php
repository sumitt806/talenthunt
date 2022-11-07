<?php

namespace App\Queries;

use App\Models\ReportedToCompany;

/**
 * Class ReportedCompanyDataTable
 */
class ReportedCompanyDataTable
{
    /**
     * @return ReportedToCompany
     */
    public function get()
    {
        /** @var ReportedToCompany $query */
        $query = ReportedToCompany::with(['user', 'company.user'])->select('reported_to_companies.*')->get();

        $result = $data =  [];
        $query->map(function (ReportedToCompany $reportedToCompany) use($data, &$result){
            $data['id'] = $reportedToCompany->id;
            $data['user'] = [
                'full_name' => $reportedToCompany->user->full_name,
                'first_name' => $reportedToCompany->user->first_name,
                'last_name' => $reportedToCompany->user->last_name,
            ];
            $data['company']['user'] = [
                'full_name' => $reportedToCompany->company->user->full_name,
                'first_name' => $reportedToCompany->company->user->first_name,
                'last_name' => $reportedToCompany->company->user->last_name,
            ];
            $data['note'] = $reportedToCompany->note;
            $data['created_at'] = $reportedToCompany->created_at->toDateTimeString();

            $result[] = $data;
        });

        return $result;
    }
}
