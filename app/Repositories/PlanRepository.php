<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Job;
use App\Models\Plan;
use App\Models\Subscription;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class PlanRepository
{
    /**
     * @param $input
     *
     * @throws Exception
     *
     * @return bool
     *
     */
    public function createPlan($input)
    {
        $input['amount'] = formatNumber($input['amount']);

        try {
            DB::beginTransaction();

            /** @var Plan $plan */
            $plan = Plan::create($input);

            $stripe = new StripeClient(
                config('services.stripe.secret_key')
            );
            $product = $stripe->products->create([
                'name' => $plan->name,
                'type' => 'service',
            ]);

            $stripePlan = $stripe->plans->create([
                'amount'   => $plan->amount * 100,
                'currency' => 'usd',
                'interval' => 'month',
                'product'  => $product->id,
            ]);

            $plan->update([
                'stripe_plan_id' => $stripePlan->id,
            ]);
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  array  $input
     * @param  Plan  $plan
     *
     * @throws Exception
     *
     * @return bool
     */
    public function updatePlan($input, $plan)
    {
        $input['amount'] = formatNumber($input['amount']);

        try {
            $subscriptionExists = Subscription::wherePlanId($plan->id)
                ->active()
                ->latest()
                ->first();
            if ($subscriptionExists) {
                return false;
            }

            DB::beginTransaction();
            $plan->update($input);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  Plan  $plan
     *
     * @throws Exception
     */
    public function deletePlan($plan)
    {
        try {
            DB::beginTransaction();

            $plan->delete();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $stripe = new \Stripe\StripeClient(
                config('services.stripe.secret_key')
            );
            $deletedStripePlan = $stripe->plans->delete(
                $plan->stripe_plan_id,
                []
            );
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     *
     * @return null
     */
    public function getPlans()
    {
        /** @var Company $company */
        $company = Company::whereUserId(Auth::id())->first();

        $data['subscription'] = Subscription::whereUserId($company->user_id)
            ->active()
            ->latest()
            ->first();

        $data['jobsCount'] = Job::whereStatus(Job::STATUS_OPEN)->where('company_id', $company->id)->count();

        $data['plans'] = Plan::orderBy('amount', 'ASC')->get();

        return $data;
    }
}
