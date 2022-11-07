<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class DefaultTrialPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     * @return void
     */
    public function run()
    {
        $plan = [
            'name'          => 'Trial Plan',
            'allowed_jobs'  => 1,
            'amount'        => 0,
            'is_trial_plan' => 1,
        ];

        Plan::create($plan);
    }
}
