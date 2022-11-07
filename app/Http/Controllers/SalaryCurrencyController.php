<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalaryCurrencyRequest;
use App\Http\Requests\UpdateSalaryCurrencyRequest;
use App\Models\SalaryCurrency;
use App\Queries\SalaryCurrencyDataTable;
use App\Repositories\SalaryCurrencyRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class SalaryCurrencyController extends AppBaseController
{
    /** @var  SalaryCurrencyRepository */
    private $salaryCurrencyRepository;

    public function __construct(SalaryCurrencyRepository $salaryCurrencyRepo)
    {
        $this->salaryCurrencyRepository = $salaryCurrencyRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new SalaryCurrencyDataTable())->get())->make(true);
        }

        return view('salary_currencies.index');
    }

    /**
     * Store a newly created SalaryCurrency in storage.
     *
     * @param  CreateSalaryCurrencyRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateSalaryCurrencyRequest $request)
    {
        $input = $request->all();
        $this->salaryCurrencyRepository->create($input);

        return $this->sendSuccess('Salary Currency saved successfully.');
    }

    /**
     * Show the form for editing the specified SalaryCurrency.
     *
     * @param  SalaryCurrency  $salaryCurrency
     *
     * @return JsonResource
     */
    public function edit(SalaryCurrency $salaryCurrency)
    {
        return $this->sendResponse($salaryCurrency, 'Salary Currency successfully retrieved.');
    }

    /**
     * Update the specified SalaryCurrency in storage.
     *
     * @param  SalaryCurrency  $salaryCurrency
     * @param  UpdateSalaryCurrencyRequest  $request
     *
     * @return JsonResource
     */
    public function update(UpdateSalaryCurrencyRequest $request, SalaryCurrency $salaryCurrency)
    {
        $input = $request->all();
        $this->salaryCurrencyRepository->update($input, $salaryCurrency->id);

        return $this->sendSuccess('Salary Currency updated successfully.');
    }

    /**
     * Remove the specified SalaryCurrency from storage.
     *
     * @param  SalaryCurrency  $salaryCurrency
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(SalaryCurrency $salaryCurrency)
    {
        $salaryCurrency->delete();

        return $this->sendSuccess('Salary Currency deleted successfully.');
    }
}
