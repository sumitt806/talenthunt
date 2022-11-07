<?php

namespace App\Queries;

use App\Models\FavouriteCompany;

/**
 * Class FollowerDataTable
 */
class FollowerDataTable
{
    public function get()
    {
        /** @var FavouriteCompany $query */
        $query = FavouriteCompany::with([
            'user.candidate', 'company.user',
        ])->select('favourite_companies.*')->where('company_id',
            getLoggedInUser()->owner_id);

        return $query;
    }
}
