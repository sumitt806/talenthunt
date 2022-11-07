<?php

namespace App\Queries;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class CandidateDataTable
 */
class CandidateDataTable
{
    /**
     * @return Candidate
     */
    public function get($input = [])
    {
        /** @var Candidate $query */
        $query = Candidate::with('user', 'industry')->select('candidates.*');

        $query->when(isset($input['is_status']) && $input['is_status'] == 1,
            function (Builder $q) use ($input) {
                $q->whereHas('user', function (Builder $q) {
                    $q->where('is_active', '=', 1);
                });
            });

        $query->when(isset($input['is_status']) && $input['is_status'] == 0,
            function (Builder $q) use ($input) {
                $q->wherehas('user', function (Builder $q) {
                    $q->where('is_active', '=', 0);
                });
            });

        return $query;
    }
}
