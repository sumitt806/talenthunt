<?php

namespace App\Queries;

use App\Models\FavouriteJob;

/**
 * Class FavouriteJobDataTable
 */
class FavouriteJobDataTable
{
    /**
     * @return FavouriteJob
     */
    public function get()
    {
        /** @var FavouriteJob $query */
        $query = FavouriteJob::with([
            'user', 'job', 'job.country', 'job.state', 'job.city',
        ])->select('favourite_jobs.*')->where('user_id', getLoggedInUserId());

        return $query;
    }
}
