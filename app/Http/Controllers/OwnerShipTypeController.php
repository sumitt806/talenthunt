<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOwnerShipTypeRequest;
use App\Http\Requests\UpdateOwnerShipTypeRequest;
use App\Models\OwnerShipType;
use App\Queries\OwnerShipTypeDataTable;
use App\Repositories\OwnerShipTypeRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Response;
use Yajra\DataTables\Facades\DataTables;

class OwnerShipTypeController extends AppBaseController
{
    /** @var  OwnerShipTypeRepository */
    private $ownerShipTypeRepository;

    public function __construct(OwnerShipTypeRepository $ownerShipTypeRepo)
    {
        $this->ownerShipTypeRepository = $ownerShipTypeRepo;
    }

    /**
     * Display a listing of the OwnerShipType.
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
            return DataTables::of((new OwnerShipTypeDataTable())->get())->make(true);
        }

        return view('ownership_types.index');
    }

    /**
     * Store a newly created OwnerShipType in storage.
     *
     * @param  CreateOwnerShipTypeRequest  $request
     *
     * @return Response
     */
    public function store(CreateOwnerShipTypeRequest $request)
    {
        $input = $request->all();

        $ownerShipType = $this->ownerShipTypeRepository->create($input);

        return $this->sendSuccess('OwnerShip Type saved successfully.');
    }

    /**
     * Display the specified OwnerShipType.
     *
     * @param  OwnerShipType  $ownerShipType
     *
     * @return Response
     */
    public function show(OwnerShipType $ownerShipType)
    {
        return $this->sendResponse($ownerShipType, 'OwnerShip Type retrieved successfully.');
    }

    /**
     * Show the form for editing the specified OwnerShipType.
     *
     * @param  OwnerShipType  $ownerShipType
     *
     * @return Response
     */
    public function edit(OwnerShipType $ownerShipType)
    {
        return $this->sendResponse($ownerShipType, 'OwnerShip Type retrieved successfully.');
    }

    /**
     * Update the specified OwnerShipType in storage.
     *
     * @param  OwnerShipType  $ownerShipType
     * @param  UpdateOwnerShipTypeRequest  $request
     *
     * @return Response
     */
    public function update(OwnerShipType $ownerShipType, UpdateOwnerShipTypeRequest $request)
    {
        $ownerShipType = $this->ownerShipTypeRepository->update($request->all(), $ownerShipType->id);

        return $this->sendSuccess('OwnerShip Type updated successfully.');
    }

    /**
     * Remove the specified OwnerShipType from storage.
     *
     * @param  OwnerShipType  $ownerShipType
     *
     * @throws Exception
     *
     * @return Response
     */
    public function destroy(OwnerShipType $ownerShipType)
    {
        $this->ownerShipTypeRepository->delete($ownerShipType->id);

        return $this->sendSuccess('OwnerShip Type deleted successfully.');
    }
}
