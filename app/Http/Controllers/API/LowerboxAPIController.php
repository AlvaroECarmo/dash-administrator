<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateLowerboxAPIRequest;
use App\Http\Requests\API\UpdateLowerboxAPIRequest;
use App\Http\Resources\LowerboxResource;
use App\Models\Parlamento\Lowerbox;
use App\Repositories\Parlamento\LowerboxRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class LowerboxController
 * @package App\Http\Controllers\API
 */

class LowerboxAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\LowerboxRepository */
    private $lowerboxRepository;

    public function __construct(LowerboxRepository $lowerboxRepo)
    {
        $this->lowerboxRepository = $lowerboxRepo;
    }

    /**
     * Display a listing of the Lowerbox.
     * GET|HEAD /lowerboxes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $lowerboxes = $this->lowerboxRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(LowerboxResource::collection($lowerboxes), 'Lowerboxes retrieved successfully');
    }

    /**
     * Store a newly created Lowerbox in storage.
     * POST /lowerboxes
     *
     * @param CreateLowerboxAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLowerboxAPIRequest $request)
    {
        $input = $request->all();

        $lowerbox = $this->lowerboxRepository->create($input);

        return $this->sendResponse(new LowerboxResource($lowerbox), 'Lowerbox saved successfully');
    }

    /**
     * Display the specified Lowerbox.
     * GET|HEAD /lowerboxes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Lowerbox $lowerbox */
        $lowerbox = $this->lowerboxRepository->find($id);

        if (empty($lowerbox)) {
            return $this->sendError('Lowerbox not found');
        }

        return $this->sendResponse(new LowerboxResource($lowerbox), 'Lowerbox retrieved successfully');
    }

    /**
     * Update the specified Lowerbox in storage.
     * PUT/PATCH /lowerboxes/{id}
     *
     * @param int $id
     * @param UpdateLowerboxAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLowerboxAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lowerbox $lowerbox */
        $lowerbox = $this->lowerboxRepository->find($id);

        if (empty($lowerbox)) {
            return $this->sendError('Lowerbox not found');
        }

        $lowerbox = $this->lowerboxRepository->update($input, $id);

        return $this->sendResponse(new LowerboxResource($lowerbox), 'Lowerbox updated successfully');
    }

    /**
     * Remove the specified Lowerbox from storage.
     * DELETE /lowerboxes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Lowerbox $lowerbox */
        $lowerbox = $this->lowerboxRepository->find($id);

        if (empty($lowerbox)) {
            return $this->sendError('Lowerbox not found');
        }

        $lowerbox->delete();

        return $this->sendSuccess('Lowerbox deleted successfully');
    }
}
