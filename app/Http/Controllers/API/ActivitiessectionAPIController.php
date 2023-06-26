<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateActivitiessectionAPIRequest;
use App\Http\Requests\API\UpdateActivitiessectionAPIRequest;
use App\Http\Resources\ActivitiessectionResource;
use App\Models\Parlamento\Activitiessection;
use App\Repositories\Parlamento\ActivitiessectionRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ActivitiessectionController
 * @package App\Http\Controllers\API
 */
class ActivitiessectionAPIController extends AppBaseController
{
    /** @var  ActivitiessectionRepository */
    private $activitiessectionRepository;

    public function __construct(ActivitiessectionRepository $activitiessectionRepo)
    {
        $this->activitiessectionRepository = $activitiessectionRepo;
    }

    /**
     * Display a listing of the Activitiessection.
     * GET|HEAD /activitiessections
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $activitiessections = $this->activitiessectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ActivitiessectionResource::collection($activitiessections), 'Activitiessections retrieved successfully');
    }

    /**
     * Store a newly created Activitiessection in storage.
     * POST /activitiessections
     *
     * @param CreateActivitiessectionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateActivitiessectionAPIRequest $request)
    {
        $input = $request->all();

        $activitiessection = $this->activitiessectionRepository->create($input);

        return $this->sendResponse(new ActivitiessectionResource($activitiessection), 'Activitiessection saved successfully');
    }

    /**
     * Display the specified Activitiessection.
     * GET|HEAD /activitiessections/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Activitiessection $activitiessection */
        $activitiessection = $this->activitiessectionRepository->find($id);

        if (empty($activitiessection)) {
            return $this->sendError('Activitiessection not found');
        }

        return $this->sendResponse(new ActivitiessectionResource($activitiessection), 'Activitiessection retrieved successfully');
    }

    /**
     * Update the specified Activitiessection in storage.
     * PUT/PATCH /activitiessections/{id}
     *
     * @param int $id
     * @param UpdateActivitiessectionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivitiessectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Activitiessection $activitiessection */
        $activitiessection = $this->activitiessectionRepository->find($id);

        if (empty($activitiessection)) {
            return $this->sendError('Activitiessection not found');
        }

        $activitiessection = $this->activitiessectionRepository->update($input, $id);

        return $this->sendResponse(new ActivitiessectionResource($activitiessection), 'Activitiessection updated successfully');
    }

    /**
     * Remove the specified Activitiessection from storage.
     * DELETE /activitiessections/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Activitiessection $activitiessection */
        $activitiessection = $this->activitiessectionRepository->find($id);

        if (empty($activitiessection)) {
            return $this->sendError('Activitiessection not found');
        }

        $activitiessection->delete();

        return $this->sendSuccess('Activitiessection deleted successfully');
    }

    public static function activitiesSection()
    {
        return Activitiessection::orderBy('id', 'desc')->get()->take(5);
    }
}
