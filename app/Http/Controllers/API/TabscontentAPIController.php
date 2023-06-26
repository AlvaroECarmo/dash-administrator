<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTabscontentAPIRequest;
use App\Http\Requests\API\UpdateTabscontentAPIRequest;
use App\Http\Resources\TabscontentResource;
use App\Repositories\Parlamento\TabscontentRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class TabscontentController
 * @package App\Http\Controllers\API
 */

class TabscontentAPIController extends AppBaseController
{
    /** @var  TabscontentRepository */
    private $tabscontentRepository;

    public function __construct(TabscontentRepository $tabscontentRepo)
    {
        $this->tabscontentRepository = $tabscontentRepo;
    }

    /**
     * Display a listing of the Tabscontent.
     * GET|HEAD /tabscontents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tabscontents = $this->tabscontentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TabscontentResource::collection($tabscontents), 'Tabscontents retrieved successfully');
    }

    /**
     * Store a newly created Tabscontent in storage.
     * POST /tabscontents
     *
     * @param CreateTabscontentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTabscontentAPIRequest $request)
    {
        $input = $request->all();

        $tabscontent = $this->tabscontentRepository->create($input);

        return $this->sendResponse(new TabscontentResource($tabscontent), 'Tabscontent saved successfully');
    }

    /**
     * Display the specified Tabscontent.
     * GET|HEAD /tabscontents/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Tabscontent $tabscontent */
        $tabscontent = $this->tabscontentRepository->find($id);

        if (empty($tabscontent)) {
            return $this->sendError('Tabscontent not found');
        }

        return $this->sendResponse(new TabscontentResource($tabscontent), 'Tabscontent retrieved successfully');
    }

    /**
     * Update the specified Tabscontent in storage.
     * PUT/PATCH /tabscontents/{id}
     *
     * @param int $id
     * @param UpdateTabscontentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTabscontentAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Tabscontent $tabscontent */
        $tabscontent = $this->tabscontentRepository->find($id);

        if (empty($tabscontent)) {
            return $this->sendError('Tabscontent not found');
        }

        $tabscontent = $this->tabscontentRepository->update($input, $id);

        return $this->sendResponse(new TabscontentResource($tabscontent), 'Tabscontent updated successfully');
    }

    /**
     * Remove the specified Tabscontent from storage.
     * DELETE /tabscontents/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Tabscontent $tabscontent */
        $tabscontent = $this->tabscontentRepository->find($id);

        if (empty($tabscontent)) {
            return $this->sendError('Tabscontent not found');
        }

        $tabscontent->delete();

        return $this->sendSuccess('Tabscontent deleted successfully');
    }
}
