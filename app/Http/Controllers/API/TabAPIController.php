<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTabAPIRequest;
use App\Http\Requests\API\UpdateTabAPIRequest;
use App\Http\Resources\TabResource;
use App\Repositories\Parlamento\TabRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class TabController
 * @package App\Http\Controllers\API
 */

class TabAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\TabRepository */
    private $tabRepository;

    public function __construct(TabRepository $tabRepo)
    {
        $this->tabRepository = $tabRepo;
    }

    /**
     * Display a listing of the Tab.
     * GET|HEAD /tabs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tabs = $this->tabRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TabResource::collection($tabs), 'Tabs retrieved successfully');
    }

    /**
     * Store a newly created Tab in storage.
     * POST /tabs
     *
     * @param CreateTabAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTabAPIRequest $request)
    {
        $input = $request->all();

        $tab = $this->tabRepository->create($input);

        return $this->sendResponse(new TabResource($tab), 'Tab saved successfully');
    }

    /**
     * Display the specified Tab.
     * GET|HEAD /tabs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Tab $tab */
        $tab = $this->tabRepository->find($id);

        if (empty($tab)) {
            return $this->sendError('Tab not found');
        }

        return $this->sendResponse(new TabResource($tab), 'Tab retrieved successfully');
    }

    /**
     * Update the specified Tab in storage.
     * PUT/PATCH /tabs/{id}
     *
     * @param int $id
     * @param UpdateTabAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTabAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Tab $tab */
        $tab = $this->tabRepository->find($id);

        if (empty($tab)) {
            return $this->sendError('Tab not found');
        }

        $tab = $this->tabRepository->update($input, $id);

        return $this->sendResponse(new TabResource($tab), 'Tab updated successfully');
    }

    /**
     * Remove the specified Tab from storage.
     * DELETE /tabs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Tab $tab */
        $tab = $this->tabRepository->find($id);

        if (empty($tab)) {
            return $this->sendError('Tab not found');
        }

        $tab->delete();

        return $this->sendSuccess('Tab deleted successfully');
    }
}
