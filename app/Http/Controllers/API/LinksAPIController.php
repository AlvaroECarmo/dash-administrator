<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateLinksAPIRequest;
use App\Http\Requests\API\UpdateLinksAPIRequest;
use App\Http\Resources\LinksResource;
use App\Models\Parlamento\Links;
use App\Repositories\Parlamento\LinksRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class LinksController
 * @package App\Http\Controllers\API
 */

class LinksAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\LinksRepository */
    private $linksRepository;

    public function __construct(LinksRepository $linksRepo)
    {
        $this->linksRepository = $linksRepo;
    }

    /**
     * Display a listing of the Links.
     * GET|HEAD /links
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $links = $this->linksRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(LinksResource::collection($links), 'Links retrieved successfully');
    }

    /**
     * Store a newly created Links in storage.
     * POST /links
     *
     * @param CreateLinksAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLinksAPIRequest $request)
    {
        $input = $request->all();

        $links = $this->linksRepository->create($input);

        return $this->sendResponse(new LinksResource($links), 'Links saved successfully');
    }

    /**
     * Display the specified Links.
     * GET|HEAD /links/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Links $links */
        $links = $this->linksRepository->find($id);

        if (empty($links)) {
            return $this->sendError('Links not found');
        }

        return $this->sendResponse(new LinksResource($links), 'Links retrieved successfully');
    }

    /**
     * Update the specified Links in storage.
     * PUT/PATCH /links/{id}
     *
     * @param int $id
     * @param UpdateLinksAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLinksAPIRequest $request)
    {
        $input = $request->all();

        /** @var Links $links */
        $links = $this->linksRepository->find($id);

        if (empty($links)) {
            return $this->sendError('Links not found');
        }

        $links = $this->linksRepository->update($input, $id);

        return $this->sendResponse(new LinksResource($links), 'Links updated successfully');
    }

    /**
     * Remove the specified Links from storage.
     * DELETE /links/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Links $links */
        $links = $this->linksRepository->find($id);

        if (empty($links)) {
            return $this->sendError('Links not found');
        }

        $links->delete();

        return $this->sendSuccess('Links deleted successfully');
    }
}
