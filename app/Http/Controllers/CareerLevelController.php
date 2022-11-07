<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCareerLevelRequest;
use App\Http\Requests\UpdateCareerLevelRequest;
use App\Models\CareerLevel;
use App\Queries\CareerLevelDataTable;
use App\Repositories\CareerLevelRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\View\View;

class CareerLevelController extends AppBaseController
{
    /** @var  CareerLevelRepository */
    private $careerLevelRepository;

    public function __construct(CareerLevelRepository $careerLevelRepo)
    {
        $this->careerLevelRepository = $careerLevelRepo;
    }

    /**
     * Display a listing of the CareerLevel.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new CareerLevelDataTable())->get())->make(true);
        }

        return view('career_levels.index');
    }

    /**
     * Store a newly created CareerLevel in storage.
     *
     * @param  CreateCareerLevelRequest  $request
     *
     * @return JsonResource
     */
    public function store(CreateCareerLevelRequest $request)
    {
        $input = $request->all();
        $this->careerLevelRepository->create($input);

        return $this->sendSuccess('Career Level saved successfully.');
    }

    /**
     * Show the form for editing the specified CareerLevel.
     *
     * @param  CareerLevel  $careerLevel
     *
     * @return JsonResource
     */
    public function edit(CareerLevel $careerLevel)
    {
        return $this->sendResponse($careerLevel, 'Career Level successfully retrieved.');
    }

    /**
     * Update the specified CareerLevel in storage.
     *
     * @param  UpdateCareerLevelRequest  $request
     *
     * @param  CareerLevel  $careerLevel
     *
     * @return JsonResource
     */
    public function update(UpdateCareerLevelRequest $request, CareerLevel $careerLevel)
    {
        $input = $request->all();
        $this->careerLevelRepository->update($input, $careerLevel->id);

        return $this->sendSuccess('Career Level updated successfully.');
    }

    /**
     * Remove the specified CareerLevel from storage.
     *
     * @param  CareerLevel  $careerLevel
     *
     * @throws Exception
     *
     * @return JsonResource
     */
    public function destroy(CareerLevel $careerLevel)
    {
        $careerLevel->delete();

        return $this->sendSuccess('Career Level deleted successfully.');
    }
}
