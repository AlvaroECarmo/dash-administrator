<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateSolutionssectionAPIRequest;
use App\Http\Requests\API\UpdateSolutionssectionAPIRequest;
use App\Http\Resources\SolutionssectionResource;
use App\Models\Parlamento\Solutionssection;
use App\Repositories\Parlamento\SolutionssectionRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class SolutionssectionController
 * @package App\Http\Controllers\API
 */
class SolutionssectionAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\SolutionssectionRepository */
    private $solutionssectionRepository;

    public function __construct(SolutionssectionRepository $solutionssectionRepo)
    {
        $this->solutionssectionRepository = $solutionssectionRepo;
    }

    /**
     * Display a listing of the Solutionssection.
     * GET|HEAD /solutionssections
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $solutionssections = $this->solutionssectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SolutionssectionResource::collection($solutionssections), 'Solutionssections retrieved successfully');
    }

    /**
     * Store a newly created Solutionssection in storage.
     * POST /solutionssections
     *
     * @param CreateSolutionssectionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSolutionssectionAPIRequest $request)
    {
        $input = $request->all();

        $solutionssection = $this->solutionssectionRepository->create($input);

        return $this->sendResponse(new SolutionssectionResource($solutionssection), 'Solutionssection saved successfully');
    }

    /**
     * Display the specified Solutionssection.
     * GET|HEAD /solutionssections/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Solutionssection $solutionssection */
        $solutionssection = $this->solutionssectionRepository->find($id);

        if (empty($solutionssection)) {
            return $this->sendError('Solutionssection not found');
        }

        return $this->sendResponse(new SolutionssectionResource($solutionssection), 'Solutionssection retrieved successfully');
    }

    /**
     * Update the specified Solutionssection in storage.
     * PUT/PATCH /solutionssections/{id}
     *
     * @param int $id
     * @param UpdateSolutionssectionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSolutionssectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Solutionssection $solutionssection */
        $solutionssection = $this->solutionssectionRepository->find($id);

        if (empty($solutionssection)) {
            return $this->sendError('Solutionssection not found');
        }

        $solutionssection = $this->solutionssectionRepository->update($input, $id);

        return $this->sendResponse(new SolutionssectionResource($solutionssection), 'Solutionssection updated successfully');
    }

    /**
     * Remove the specified Solutionssection from storage.
     * DELETE /solutionssections/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Solutionssection $solutionssection */
        $solutionssection = $this->solutionssectionRepository->find($id);

        if (empty($solutionssection)) {
            return $this->sendError('Solutionssection not found');
        }

        $solutionssection->delete();

        return $this->sendSuccess('Solutionssection deleted successfully');
    }

    public static function solutionsSection()
    {
        return Solutionssection::with('listSection'
            , 'figure'
            , 'images'
            , 'clearfix'
        )->latest()->first();
    }
}
