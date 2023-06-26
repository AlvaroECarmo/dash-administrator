<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateHeadercontentAPIRequest;
use App\Http\Requests\API\UpdateHeadercontentAPIRequest;
use App\Http\Resources\HeadercontentResource;
use App\Models\Parlamento\Headercontent;
use App\Repositories\Parlamento\HeadercontentRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class HeadercontentController
 * @package App\Http\Controllers\API
 */

class HeadercontentAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\HeadercontentRepository */
    private $headercontentRepository;

    public function __construct(HeadercontentRepository $headercontentRepo)
    {
        $this->headercontentRepository = $headercontentRepo;
    }

    /**
     * Display a listing of the Headercontent.
     * GET|HEAD /headercontents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $headercontents = $this->headercontentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(HeadercontentResource::collection($headercontents), 'Headercontents retrieved successfully');
    }

    /**
     * Store a newly created Headercontent in storage.
     * POST /headercontents
     *
     * @param CreateHeadercontentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHeadercontentAPIRequest $request)
    {
        $input = $request->all();

        $headercontent = $this->headercontentRepository->create($input);

        return $this->sendResponse(new HeadercontentResource($headercontent), 'Headercontent saved successfully');
    }

    /**
     * Display the specified Headercontent.
     * GET|HEAD /headercontents/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Headercontent $headercontent */
        $headercontent = $this->headercontentRepository->find($id);

        if (empty($headercontent)) {
            return $this->sendError('Headercontent not found');
        }

        return $this->sendResponse(new HeadercontentResource($headercontent), 'Headercontent retrieved successfully');
    }

    /**
     * Update the specified Headercontent in storage.
     * PUT/PATCH /headercontents/{id}
     *
     * @param int $id
     * @param UpdateHeadercontentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHeadercontentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Headercontent $headercontent */
        $headercontent = $this->headercontentRepository->find($id);

        if (empty($headercontent)) {
            return $this->sendError('Headercontent not found');
        }

        $headercontent = $this->headercontentRepository->update($input, $id);

        return $this->sendResponse(new HeadercontentResource($headercontent), 'Headercontent updated successfully');
    }

    /**
     * Remove the specified Headercontent from storage.
     * DELETE /headercontents/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Headercontent $headercontent */
        $headercontent = $this->headercontentRepository->find($id);

        if (empty($headercontent)) {
            return $this->sendError('Headercontent not found');
        }

        $headercontent->delete();

        return $this->sendSuccess('Headercontent deleted successfully');
    }
}
