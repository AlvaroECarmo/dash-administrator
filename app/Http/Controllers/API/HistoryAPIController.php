<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateHistoryAPIRequest;
use App\Http\Requests\API\UpdateHistoryAPIRequest;
use App\Http\Resources\HistoryResource;
use App\Repositories\Parlamento\HistoryRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class HistoryController
 * @package App\Http\Controllers\API
 */

class HistoryAPIController extends AppBaseController
{
    /** @var  HistoryRepository */
    private $historyRepository;

    public function __construct(HistoryRepository $historyRepo)
    {
        $this->historyRepository = $historyRepo;
    }

    /**
     * Display a listing of the History.
     * GET|HEAD /histories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $histories = $this->historyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(HistoryResource::collection($histories), 'Histories retrieved successfully');
    }

    /**
     * Store a newly created History in storage.
     * POST /histories
     *
     * @param CreateHistoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHistoryAPIRequest $request)
    {
        $input = $request->all();

        $history = $this->historyRepository->create($input);

        return $this->sendResponse(new HistoryResource($history), 'History saved successfully');
    }

    /**
     * Display the specified History.
     * GET|HEAD /histories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\History $history */
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            return $this->sendError('History not found');
        }

        return $this->sendResponse(new HistoryResource($history), 'History retrieved successfully');
    }

    /**
     * Update the specified History in storage.
     * PUT/PATCH /histories/{id}
     *
     * @param int $id
     * @param UpdateHistoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHistoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\History $history */
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            return $this->sendError('History not found');
        }

        $history = $this->historyRepository->update($input, $id);

        return $this->sendResponse(new HistoryResource($history), 'History updated successfully');
    }

    /**
     * Remove the specified History from storage.
     * DELETE /histories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\History $history */
        $history = $this->historyRepository->find($id);

        if (empty($history)) {
            return $this->sendError('History not found');
        }

        $history->delete();

        return $this->sendSuccess('History deleted successfully');
    }
}
