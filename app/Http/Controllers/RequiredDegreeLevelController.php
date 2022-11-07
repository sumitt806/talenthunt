<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequiredDegreeLevelRequest;
use App\Http\Requests\UpdateRequiredDegreeLevelRequest;
use App\Models\RequiredDegreeLevel;
use App\Queries\RequiredDegreeLevelDataTable;
use App\Repositories\RequiredDegreeLevelRepository;
use DataTables;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;

class RequiredDegreeLevelController extends AppBaseController
{
    /** @var  RequiredDegreeLevelRepository */
    private $requiredDegreeLevelRepository;

    public function __construct(RequiredDegreeLevelRepository $requiredDegreeLevelRepo)
    {
        $this->requiredDegreeLevelRepository = $requiredDegreeLevelRepo;
    }

    /**
     * Display a listing of the JobType.
     *
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new RequiredDegreeLevelDataTable())->get())->make(true);
        }

        return view('required_degree_levels.index');
    }

    /**
     * Store a newly created RequiredDegreeLevel in storage.
     *
     * @param  CreateRequiredDegreeLevelRequest  $request
     *
     * @return Response
     */
    public function store(CreateRequiredDegreeLevelRequest $request)
    {
        $input = $request->all();
        $this->requiredDegreeLevelRepository->create($input);

        return $this->sendSuccess('Degree Level saved successfully.');
    }

    /**
     * Display the specified RequiredDegreeLevel.
     *
     * @param  RequiredDegreeLevel  $requiredDegreeLevel
     *
     * @return Response
     */
    public function show(RequiredDegreeLevel $requiredDegreeLevel)
    {
        return $this->sendResponse($requiredDegreeLevel, 'Degree Level Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified RequiredDegreeLevel.
     *
     * @param  RequiredDegreeLevel  $requiredDegreeLevel
     *
     * @return Response
     */
    public function edit(RequiredDegreeLevel $requiredDegreeLevel)
    {
        return $this->sendResponse($requiredDegreeLevel, 'Degree Level Successfully.');
    }

    /**
     * Update the specified RequiredDegreeLevel in storage.
     *
     * @param  UpdateRequiredDegreeLevelRequest  $request
     * @param  RequiredDegreeLevel  $requiredDegreeLevel
     *
     * @return Response
     */
    public function update(UpdateRequiredDegreeLevelRequest $request, RequiredDegreeLevel $requiredDegreeLevel)
    {
        $input = $request->all();
        $this->requiredDegreeLevelRepository->update($input, $requiredDegreeLevel->id);

        return $this->sendSuccess('Degree Level updated successfully.');
    }

    /**
     * Remove the specified RequiredDegreeLevel from storage.
     *
     * @param  RequiredDegreeLevel  $requiredDegreeLevel
     *
     * @throws Exception
     * @return Response
     *
     */
    public function destroy(RequiredDegreeLevel $requiredDegreeLevel)
    {
        $requiredDegreeLevel->delete();

        return $this->sendSuccess('Degree Level deleted successfully.');
    }
}
