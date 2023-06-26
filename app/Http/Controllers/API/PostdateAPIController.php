<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreatePostdateAPIRequest;
use App\Http\Requests\API\UpdatePostdateAPIRequest;
use App\Http\Resources\PostdateResource;
use App\Models\Parlamento\Postdate;
use App\Repositories\Parlamento\PostdateRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class PostdateController
 * @package App\Http\Controllers\API
 */

class PostdateAPIController extends AppBaseController
{
    /** @var  PostdateRepository */
    private $postdateRepository;

    public function __construct(PostdateRepository $postdateRepo)
    {
        $this->postdateRepository = $postdateRepo;
    }

    /**
     * Display a listing of the Postdate.
     * GET|HEAD /postdates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $postdates = $this->postdateRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PostdateResource::collection($postdates), 'Postdates retrieved successfully');
    }

    /**
     * Store a newly created Postdate in storage.
     * POST /postdates
     *
     * @param CreatePostdateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostdateAPIRequest $request)
    {
        $input = $request->all();

        $postdate = $this->postdateRepository->create($input);

        return $this->sendResponse(new PostdateResource($postdate), 'Postdate saved successfully');
    }

    /**
     * Display the specified Postdate.
     * GET|HEAD /postdates/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Postdate $postdate */
        $postdate = $this->postdateRepository->find($id);

        if (empty($postdate)) {
            return $this->sendError('Postdate not found');
        }

        return $this->sendResponse(new PostdateResource($postdate), 'Postdate retrieved successfully');
    }

    /**
     * Update the specified Postdate in storage.
     * PUT/PATCH /postdates/{id}
     *
     * @param int $id
     * @param UpdatePostdateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostdateAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Postdate $postdate */
        $postdate = $this->postdateRepository->find($id);

        if (empty($postdate)) {
            return $this->sendError('Postdate not found');
        }

        $postdate = $this->postdateRepository->update($input, $id);

        return $this->sendResponse(new PostdateResource($postdate), 'Postdate updated successfully');
    }

    /**
     * Remove the specified Postdate from storage.
     * DELETE /postdates/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Postdate $postdate */
        $postdate = $this->postdateRepository->find($id);

        if (empty($postdate)) {
            return $this->sendError('Postdate not found');
        }

        $postdate->delete();

        return $this->sendSuccess('Postdate deleted successfully');
    }
}
