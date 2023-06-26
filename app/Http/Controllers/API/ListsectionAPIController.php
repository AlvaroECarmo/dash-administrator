<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateListsectionAPIRequest;
use App\Http\Requests\API\UpdateListsectionAPIRequest;
use App\Http\Resources\ListsectionResource;
use App\Models\Parlamento\Listsection;
use App\Repositories\Parlamento\ListsectionRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ListsectionController
 * @package App\Http\Controllers\API
 */

class ListsectionAPIController extends AppBaseController
{
    /** @var  ListsectionRepository */
    private $listsectionRepository;

    public function __construct(ListsectionRepository $listsectionRepo)
    {
        $this->listsectionRepository = $listsectionRepo;
    }

    /**
     * Display a listing of the Listsection.
     * GET|HEAD /listsections
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $listsections = $this->listsectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ListsectionResource::collection($listsections), 'Listsections retrieved successfully');
    }

    /**
     * Store a newly created Listsection in storage.
     * POST /listsections
     *
     * @param CreateListsectionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateListsectionAPIRequest $request)
    {
        $input = $request->all();

        $listsection = $this->listsectionRepository->create($input);

        return $this->sendResponse(new ListsectionResource($listsection), 'Listsection saved successfully');
    }

    /**
     * Display the specified Listsection.
     * GET|HEAD /listsections/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Listsection $listsection */
        $listsection = $this->listsectionRepository->find($id);

        if (empty($listsection)) {
            return $this->sendError('Listsection not found');
        }

        return $this->sendResponse(new ListsectionResource($listsection), 'Listsection retrieved successfully');
    }

    /**
     * Update the specified Listsection in storage.
     * PUT/PATCH /listsections/{id}
     *
     * @param int $id
     * @param UpdateListsectionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateListsectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Listsection $listsection */
        $listsection = $this->listsectionRepository->find($id);

        if (empty($listsection)) {
            return $this->sendError('Listsection not found');
        }

        $listsection = $this->listsectionRepository->update($input, $id);

        return $this->sendResponse(new ListsectionResource($listsection), 'Listsection updated successfully');
    }

    /**
     * Remove the specified Listsection from storage.
     * DELETE /listsections/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Listsection $listsection */
        $listsection = $this->listsectionRepository->find($id);

        if (empty($listsection)) {
            return $this->sendError('Listsection not found');
        }

        $listsection->delete();

        return $this->sendSuccess('Listsection deleted successfully');
    }
}
