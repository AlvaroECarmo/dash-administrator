<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateContentdescriptionAPIRequest;
use App\Http\Requests\API\UpdateContentdescriptionAPIRequest;
use App\Http\Resources\ContentdescriptionResource;
use App\Models\Parlamento\Contentdescription;
use App\Repositories\Parlamento\ContentdescriptionRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ContentdescriptionController
 * @package App\Http\Controllers\API
 */

class ContentdescriptionAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\ContentdescriptionRepository */
    private $contentdescriptionRepository;

    public function __construct(ContentdescriptionRepository $contentdescriptionRepo)
    {
        $this->contentdescriptionRepository = $contentdescriptionRepo;
    }

    /**
     * Display a listing of the Contentdescription.
     * GET|HEAD /contentdescriptions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $contentdescriptions = $this->contentdescriptionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ContentdescriptionResource::collection($contentdescriptions), 'Contentdescriptions retrieved successfully');
    }

    /**
     * Store a newly created Contentdescription in storage.
     * POST /contentdescriptions
     *
     * @param CreateContentdescriptionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContentdescriptionAPIRequest $request)
    {
        $input = $request->all();

        $contentdescription = $this->contentdescriptionRepository->create($input);

        return $this->sendResponse(new ContentdescriptionResource($contentdescription), 'Contentdescription saved successfully');
    }

    /**
     * Display the specified Contentdescription.
     * GET|HEAD /contentdescriptions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Contentdescription $contentdescription */
        $contentdescription = $this->contentdescriptionRepository->find($id);

        if (empty($contentdescription)) {
            return $this->sendError('Contentdescription not found');
        }

        return $this->sendResponse(new ContentdescriptionResource($contentdescription), 'Contentdescription retrieved successfully');
    }

    /**
     * Update the specified Contentdescription in storage.
     * PUT/PATCH /contentdescriptions/{id}
     *
     * @param int $id
     * @param UpdateContentdescriptionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContentdescriptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Contentdescription $contentdescription */
        $contentdescription = $this->contentdescriptionRepository->find($id);

        if (empty($contentdescription)) {
            return $this->sendError('Contentdescription not found');
        }

        $contentdescription = $this->contentdescriptionRepository->update($input, $id);

        return $this->sendResponse(new ContentdescriptionResource($contentdescription), 'Contentdescription updated successfully');
    }

    /**
     * Remove the specified Contentdescription from storage.
     * DELETE /contentdescriptions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Contentdescription $contentdescription */
        $contentdescription = $this->contentdescriptionRepository->find($id);

        if (empty($contentdescription)) {
            return $this->sendError('Contentdescription not found');
        }

        $contentdescription->delete();

        return $this->sendSuccess('Contentdescription deleted successfully');
    }
}
