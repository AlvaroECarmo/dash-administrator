<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateSubscribeinnerAPIRequest;
use App\Http\Requests\API\UpdateSubscribeinnerAPIRequest;
use App\Http\Resources\SubscribeinnerResource;
use App\Models\Parlamento\Subscribeinner;
use App\Repositories\Parlamento\SubscribeinnerRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class SubscribeinnerController
 * @package App\Http\Controllers\API
 */

class SubscribeinnerAPIController extends AppBaseController
{
    /** @var  SubscribeinnerRepository */
    private $subscribeinnerRepository;

    public function __construct(SubscribeinnerRepository $subscribeinnerRepo)
    {
        $this->subscribeinnerRepository = $subscribeinnerRepo;
    }

    /**
     * Display a listing of the Subscribeinner.
     * GET|HEAD /subscribeinners
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $subscribeinners = $this->subscribeinnerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SubscribeinnerResource::collection($subscribeinners), 'Subscribeinners retrieved successfully');
    }

    /**
     * Store a newly created Subscribeinner in storage.
     * POST /subscribeinners
     *
     * @param CreateSubscribeinnerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscribeinnerAPIRequest $request)
    {
        $input = $request->all();

        $subscribeinner = $this->subscribeinnerRepository->create($input);

        return $this->sendResponse(new SubscribeinnerResource($subscribeinner), 'Subscribeinner saved successfully');
    }

    /**
     * Display the specified Subscribeinner.
     * GET|HEAD /subscribeinners/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Subscribeinner $subscribeinner */
        $subscribeinner = $this->subscribeinnerRepository->find($id);

        if (empty($subscribeinner)) {
            return $this->sendError('Subscribeinner not found');
        }

        return $this->sendResponse(new SubscribeinnerResource($subscribeinner), 'Subscribeinner retrieved successfully');
    }

    /**
     * Update the specified Subscribeinner in storage.
     * PUT/PATCH /subscribeinners/{id}
     *
     * @param int $id
     * @param UpdateSubscribeinnerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscribeinnerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Subscribeinner $subscribeinner */
        $subscribeinner = $this->subscribeinnerRepository->find($id);

        if (empty($subscribeinner)) {
            return $this->sendError('Subscribeinner not found');
        }

        $subscribeinner = $this->subscribeinnerRepository->update($input, $id);

        return $this->sendResponse(new SubscribeinnerResource($subscribeinner), 'Subscribeinner updated successfully');
    }

    /**
     * Remove the specified Subscribeinner from storage.
     * DELETE /subscribeinners/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Subscribeinner $subscribeinner */
        $subscribeinner = $this->subscribeinnerRepository->find($id);

        if (empty($subscribeinner)) {
            return $this->sendError('Subscribeinner not found');
        }

        $subscribeinner->delete();

        return $this->sendSuccess('Subscribeinner deleted successfully');
    }
}
