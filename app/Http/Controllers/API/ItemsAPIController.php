<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateItemsAPIRequest;
use App\Http\Requests\API\UpdateItemsAPIRequest;
use App\Http\Resources\ItemsResource;
use App\Models\Parlamento\Items;
use App\Repositories\Parlamento\ItemsRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ItemsController
 * @package App\Http\Controllers\API
 */

class ItemsAPIController extends AppBaseController
{
    /** @var  ItemsRepository */
    private $itemsRepository;

    public function __construct(ItemsRepository $itemsRepo)
    {
        $this->itemsRepository = $itemsRepo;
    }

    /**
     * Display a listing of the Items.
     * GET|HEAD /items
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $items = $this->itemsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ItemsResource::collection($items), 'Items retrieved successfully');
    }

    /**
     * Store a newly created Items in storage.
     * POST /items
     *
     * @param CreateItemsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemsAPIRequest $request)
    {
        $input = $request->all();

        $items = $this->itemsRepository->create($input);

        return $this->sendResponse(new ItemsResource($items), 'Items saved successfully');
    }

    /**
     * Display the specified Items.
     * GET|HEAD /items/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Items $items */
        $items = $this->itemsRepository->find($id);

        if (empty($items)) {
            return $this->sendError('Items not found');
        }

        return $this->sendResponse(new ItemsResource($items), 'Items retrieved successfully');
    }

    /**
     * Update the specified Items in storage.
     * PUT/PATCH /items/{id}
     *
     * @param int $id
     * @param UpdateItemsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemsAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Items $items */
        $items = $this->itemsRepository->find($id);

        if (empty($items)) {
            return $this->sendError('Items not found');
        }

        $items = $this->itemsRepository->update($input, $id);

        return $this->sendResponse(new ItemsResource($items), 'Items updated successfully');
    }

    /**
     * Remove the specified Items from storage.
     * DELETE /items/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Items $items */
        $items = $this->itemsRepository->find($id);

        if (empty($items)) {
            return $this->sendError('Items not found');
        }

        $items->delete();

        return $this->sendSuccess('Items deleted successfully');
    }
}
