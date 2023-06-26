<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreatePostinfoAPIRequest;
use App\Http\Requests\API\UpdatePostinfoAPIRequest;
use App\Http\Resources\PostinfoResource;
use App\Models\Parlamento\Postinfo;
use App\Repositories\Parlamento\PostinfoRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class PostinfoController
 * @package App\Http\Controllers\API
 */

class PostinfoAPIController extends AppBaseController
{
    /** @var  PostinfoRepository */
    private $postinfoRepository;

    public function __construct(PostinfoRepository $postinfoRepo)
    {
        $this->postinfoRepository = $postinfoRepo;
    }

    /**
     * Display a listing of the Postinfo.
     * GET|HEAD /postinfos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $postinfos = $this->postinfoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(PostinfoResource::collection($postinfos), 'Postinfos retrieved successfully');
    }

    /**
     * Store a newly created Postinfo in storage.
     * POST /postinfos
     *
     * @param CreatePostinfoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostinfoAPIRequest $request)
    {
        $input = $request->all();

        $postinfo = $this->postinfoRepository->create($input);

        return $this->sendResponse(new PostinfoResource($postinfo), 'Postinfo saved successfully');
    }

    /**
     * Display the specified Postinfo.
     * GET|HEAD /postinfos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Postinfo $postinfo */
        $postinfo = $this->postinfoRepository->find($id);

        if (empty($postinfo)) {
            return $this->sendError('Postinfo not found');
        }

        return $this->sendResponse(new PostinfoResource($postinfo), 'Postinfo retrieved successfully');
    }

    /**
     * Update the specified Postinfo in storage.
     * PUT/PATCH /postinfos/{id}
     *
     * @param int $id
     * @param UpdatePostinfoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostinfoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Postinfo $postinfo */
        $postinfo = $this->postinfoRepository->find($id);

        if (empty($postinfo)) {
            return $this->sendError('Postinfo not found');
        }

        $postinfo = $this->postinfoRepository->update($input, $id);

        return $this->sendResponse(new PostinfoResource($postinfo), 'Postinfo updated successfully');
    }

    /**
     * Remove the specified Postinfo from storage.
     * DELETE /postinfos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Postinfo $postinfo */
        $postinfo = $this->postinfoRepository->find($id);

        if (empty($postinfo)) {
            return $this->sendError('Postinfo not found');
        }

        $postinfo->delete();

        return $this->sendSuccess('Postinfo deleted successfully');
    }
}
