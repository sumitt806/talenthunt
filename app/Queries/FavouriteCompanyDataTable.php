<?php

namespace App\Queries;

use App\Models\FavouriteCompany;

/**
 * Class FavouriteCompanyDataTable
 */
class FavouriteCompanyDataTable
{
    /**
     * @return FavouriteCompany
     */
    public function get()
    {
        /** @var FavouriteCompany $query */
          $query = FavouriteCompany::with('company.user')->where('user_id',
              getLoggedInUserId())->get();

        return $query;
    }
}
