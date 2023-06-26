<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateClearfixAPIRequest;
use App\Http\Requests\API\UpdateClearfixAPIRequest;
use App\Http\Resources\ClearfixResource;
use App\Repositories\Parlamento\ClearfixRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ClearfixController
 * @package App\Http\Controllers\API
 */

class ClearfixAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\ClearfixRepository */
    private $clearfixRepository;

    public function __construct(ClearfixRepository $clearfixRepo)
    {
        $this->clearfixRepository = $clearfixRepo;
    }

    /**
     * Display a listing of the Clearfix.
     * GET|HEAD /clearfixes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $clearfixes = $this->clearfixRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ClearfixResource::collection($clearfixes), 'Clearfixes retrieved successfully');
    }

    /**
     * Store a newly created Clearfix in storage.
     * POST /clearfixes
     *
     * @param CreateClearfixAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateClearfixAPIRequest $request)
    {
        $input = $request->all();

        $clearfix = $this->clearfixRepository->create($input);

        return $this->sendResponse(new ClearfixResource($clearfix), 'Clearfix saved successfully');
    }

    /**
     * Display the specified Clearfix.
     * GET|HEAD /clearfixes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Clearfix $clearfix */
        $clearfix = $this->clearfixRepository->find($id);

        if (empty($clearfix)) {
            return $this->sendError('Clearfix not found');
        }

        return $this->sendResponse(new ClearfixResource($clearfix), 'Clearfix retrieved successfully');
    }

    /**
     * Update the specified Clearfix in storage.
     * PUT/PATCH /clearfixes/{id}
     *
     * @param int $id
     * @param UpdateClearfixAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClearfixAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Clearfix $clearfix */
        $clearfix = $this->clearfixRepository->find($id);

        if (empty($clearfix)) {
            return $this->sendError('Clearfix not found');
        }

        $clearfix = $this->clearfixRepository->update($input, $id);

        return $this->sendResponse(new ClearfixResource($clearfix), 'Clearfix updated successfully');
    }

    /**
     * Remove the specified Clearfix from storage.
     * DELETE /clearfixes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Clearfix $clearfix */
        $clearfix = $this->clearfixRepository->find($id);

        if (empty($clearfix)) {
            return $this->sendError('Clearfix not found');
        }

        $clearfix->delete();

        return $this->sendSuccess('Clearfix deleted successfully');
    }
}
