<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use App\Queries\PlanDataTable;
use App\Repositories\PlanRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends AppBaseController
{
    /** @var $planRepository*/
    private $planRepository;

    public function __construct(PlanRepository $PlanRepo)
    {
        $this->planRepository = $PlanRepo;
    }

    /**
     * Display a listing of the Plan.
     *
     * @param  Request  $request
     *
     * @return Factory|View
     * @throws Exception
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PlanDataTable())->get())->make(true);
        }

        return view('plans.index');
    }

    /**
     * Store a newly created Plan in storage.
     *
     * @param  CreatePlanRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreatePlanRequest $request)
    {
        try {
            $input = $request->all();
            /** @var PlanRepository $planRepo */
            $planRepo = app(PlanRepository::class);
            $planRepo->createPlan($input);

            return $this->sendSuccess('Plan saved successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Plan  $plan
     *
     * @return JsonResponse
     */
    public function edit(Plan $plan)
    {
        return $this->sendResponse($plan, 'Plan Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified Plan.
     *
     * @param  Plan  $plan
     *
     * @return JsonResource
     */
    public function show(Plan $plan)
    {
        return $this->sendResponse($plan, 'Plan Retrieved Successfully.');
    }

    /**
     * Update the specified Plan in storage.
     *
     * @param  UpdatePlanRequest  $request
     * @param  Plan  $plan
     *
     * @return JsonResource
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        try {
            $input = $request->all();
            /** @var PlanRepository $planRepo */
            $planRepo = app(PlanRepository::class);
            $updatePlan = $planRepo->updatePlan($input, $plan);
            if (! $updatePlan) {
                return $this->sendError('Plan cann\'t be update. Subscription for this plan is already exists');
            }

            return $this->sendSuccess('Plan updated successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified Plan from storage.
     *
     * @param  Plan  $plan
     *
     * @return JsonResource
     * @throws Exception
     */
    public function destroy(Plan $plan)
    {

        if ($plan->activeSubscriptions->count() > 0) {
            return $this->sendError('Plan can not be deleted, it contains one or more active subscriptions.');
        }
       
        try {
            /** @var PlanRepository $planRepo */
            $planRepo = app(PlanRepository::class);
            $planRepo->deletePlan($plan);

            return $this->sendSuccess('Plan deleted successfully.');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param Plan $plan
     *
     * @return mixed
     */
    public function changeTrialPlan(Plan $plan)
    {
        Plan::where('is_trial_plan', true)->update([
            'is_trial_plan' => false
        ]);
        $plan->update([
            'is_trial_plan' => true
        ]);

        return $this->sendSuccess('Trial Plan Updated successfully.');
    }
}
