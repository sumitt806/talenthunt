<?php

namespace App\Queries;

use App\Models\Plan;

/**
 * Class PlanDataTable
 */
class PlanDataTable
{
    /**
     * @return Plan
     */
    public function get()
    {
        /** @var Plan $query */
        $query = Plan::withCount('activeSubscriptions');

        return $query;
    }
}
