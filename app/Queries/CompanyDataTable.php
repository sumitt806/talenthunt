<?php

namespace App\Queries;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CompanyDataTable
 */
class CompanyDataTable
{
    /**
     * @return Company
     */
    public function get($input = [])
    {
        /** @var Company $query */
        $query = Company::with('user', 'activeFeatured')->select('companies.*');

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 1,
            function (Builder $q) use ($input) {
                $q->has('activeFeatured');
            });

        $query->when(isset($input['is_featured']) && $input['is_featured'] == 0,
            function (Builder $q) use ($input) {
                $q->doesnthave('activeFeatured');
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 1,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 1);
                });
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 0,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 0);
                });
            });

        $subQuery = $query->get();

        $result = $data = [];
        $subQuery->map(function (Company $company) use ($data, &$result) {
            $data['id'] = $company->id;
            $data['user'] = [
                'full_name'  => $company->user->full_name,
                'first_name' => $company->user->first_name,
                'last_name'  => $company->user->last_name,
                'email'      => $company->user->email,
                'is_active'  => $company->user->is_active,
            ];
            $data['company_url'] = $company->company_url;
            $data['active_featured'] = $company->activeFeatured;

            $result[] = $data;
        });

        return $result;
    }
}
