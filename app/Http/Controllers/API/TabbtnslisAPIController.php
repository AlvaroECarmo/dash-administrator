<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTabbtnslisAPIRequest;
use App\Http\Requests\API\UpdateTabbtnslisAPIRequest;
use App\Http\Resources\TabbtnslisResource;
use App\Models\Parlamento\Tabbtnslis;
use App\Repositories\Parlamento\TabbtnslisRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class TabbtnslisController
 * @package App\Http\Controllers\API
 */

class TabbtnslisAPIController extends AppBaseController
{
    /** @var  TabbtnslisRepository */
    private $tabbtnslisRepository;

    public function __construct(TabbtnslisRepository $tabbtnslisRepo)
    {
        $this->tabbtnslisRepository = $tabbtnslisRepo;
    }

    /**
     * Display a listing of the Tabbtnslis.
     * GET|HEAD /tabbtnslis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tabbtnslis = $this->tabbtnslisRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TabbtnslisResource::collection($tabbtnslis), 'Tabbtnslis retrieved successfully');
    }

    /**
     * Store a newly created Tabbtnslis in storage.
     * POST /tabbtnslis
     *
     * @param CreateTabbtnslisAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTabbtnslisAPIRequest $request)
    {
        $input = $request->all();

        $tabbtnslis = $this->tabbtnslisRepository->create($input);

        return $this->sendResponse(new TabbtnslisResource($tabbtnslis), 'Tabbtnslis saved successfully');
    }

    /**
     * Display the specified Tabbtnslis.
     * GET|HEAD /tabbtnslis/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tabbtnslis $tabbtnslis */
        $tabbtnslis = $this->tabbtnslisRepository->find($id);

        if (empty($tabbtnslis)) {
            return $this->sendError('Tabbtnslis not found');
        }

        return $this->sendResponse(new TabbtnslisResource($tabbtnslis), 'Tabbtnslis retrieved successfully');
    }

    /**
     * Update the specified Tabbtnslis in storage.
     * PUT/PATCH /tabbtnslis/{id}
     *
     * @param int $id
     * @param UpdateTabbtnslisAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTabbtnslisAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tabbtnslis $tabbtnslis */
        $tabbtnslis = $this->tabbtnslisRepository->find($id);

        if (empty($tabbtnslis)) {
            return $this->sendError('Tabbtnslis not found');
        }

        $tabbtnslis = $this->tabbtnslisRepository->update($input, $id);

        return $this->sendResponse(new TabbtnslisResource($tabbtnslis), 'Tabbtnslis updated successfully');
    }

    /**
     * Remove the specified Tabbtnslis from storage.
     * DELETE /tabbtnslis/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tabbtnslis $tabbtnslis */
        $tabbtnslis = $this->tabbtnslisRepository->find($id);

        if (empty($tabbtnslis)) {
            return $this->sendError('Tabbtnslis not found');
        }

        $tabbtnslis->delete();

        return $this->sendSuccess('Tabbtnslis deleted successfully');
    }
}
