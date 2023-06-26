<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateMultipleitemsAPIRequest;
use App\Http\Requests\API\UpdateMultipleitemsAPIRequest;
use App\Http\Resources\MultipleitemsResource;
use App\Models\Parlamento\Multipleitems;
use App\Repositories\Parlamento\MultipleitemsRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MultipleitemsController
 * @package App\Http\Controllers\API
 */

class MultipleitemsAPIController extends AppBaseController
{
    /** @var  MultipleitemsRepository */
    private $multipleitemsRepository;

    public function __construct(MultipleitemsRepository $multipleitemsRepo)
    {
        $this->multipleitemsRepository = $multipleitemsRepo;
    }

    /**
     * Display a listing of the Multipleitems.
     * GET|HEAD /multipleitems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $multipleitems = $this->multipleitemsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MultipleitemsResource::collection($multipleitems), 'Multipleitems retrieved successfully');
    }

    /**
     * Store a newly created Multipleitems in storage.
     * POST /multipleitems
     *
     * @param CreateMultipleitemsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMultipleitemsAPIRequest $request)
    {
        $input = $request->all();

        $multipleitems = $this->multipleitemsRepository->create($input);

        return $this->sendResponse(new MultipleitemsResource($multipleitems), 'Multipleitems saved successfully');
    }

    /**
     * Display the specified Multipleitems.
     * GET|HEAD /multipleitems/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Multipleitems $multipleitems */
        $multipleitems = $this->multipleitemsRepository->find($id);

        if (empty($multipleitems)) {
            return $this->sendError('Multipleitems not found');
        }

        return $this->sendResponse(new MultipleitemsResource($multipleitems), 'Multipleitems retrieved successfully');
    }

    /**
     * Update the specified Multipleitems in storage.
     * PUT/PATCH /multipleitems/{id}
     *
     * @param int $id
     * @param UpdateMultipleitemsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMultipleitemsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Multipleitems $multipleitems */
        $multipleitems = $this->multipleitemsRepository->find($id);

        if (empty($multipleitems)) {
            return $this->sendError('Multipleitems not found');
        }

        $multipleitems = $this->multipleitemsRepository->update($input, $id);

        return $this->sendResponse(new MultipleitemsResource($multipleitems), 'Multipleitems updated successfully');
    }

    /**
     * Remove the specified Multipleitems from storage.
     * DELETE /multipleitems/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Multipleitems $multipleitems */
        $multipleitems = $this->multipleitemsRepository->find($id);

        if (empty($multipleitems)) {
            return $this->sendError('Multipleitems not found');
        }

        $multipleitems->delete();

        return $this->sendSuccess('Multipleitems deleted successfully');
    }
}
