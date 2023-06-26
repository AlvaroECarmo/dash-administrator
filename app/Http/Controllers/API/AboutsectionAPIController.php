<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateAboutsectionAPIRequest;
use App\Http\Requests\API\UpdateAboutsectionAPIRequest;
use App\Http\Resources\AboutsectionResource;
use App\Models\Parlamento\Aboutsection;
use App\Repositories\Parlamento\AboutsectionRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class AboutsectionController
 * @package App\Http\Controllers\API
 */
class AboutsectionAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\AboutsectionRepository */
    private $aboutsectionRepository;

    public function __construct(AboutsectionRepository $aboutsectionRepo)
    {
        $this->aboutsectionRepository = $aboutsectionRepo;
    }

    /**
     * Display a listing of the Aboutsection.
     * GET|HEAD /aboutsections
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $aboutsections = Aboutsection::with(
            'social'
            , 'lowerBox'
            , 'imageBox'
        )->latest()->first();

        // $indexDataJSON = json_encode($aboutsections, true);

        file_put_contents(base_path('public/json/aboutsection.json'), $this->sendResponse($aboutsections, 'Aboutsections retrieved successfully'));

        return $this->sendResponse($aboutsections, 'Aboutsections retrieved successfully');
    }

    /**
     * Store a newly created Aboutsection in storage.
     * POST /aboutsections
     *
     * @param CreateAboutsectionAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateAboutsectionAPIRequest $request)
    {
        $input = $request->all();

        $aboutsection = $this->aboutsectionRepository->create($input);

        return $this->sendResponse(new AboutsectionResource($aboutsection), 'Aboutsection saved successfully');
    }

    /**
     * Display the specified Aboutsection.
     * GET|HEAD /aboutsections/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        /** @var Aboutsection $aboutsection */
        $aboutsection = $this->aboutsectionRepository->find($id);

        if (empty($aboutsection)) {
            return $this->sendError('Aboutsection not found');
        }

        return $this->sendResponse(new AboutsectionResource($aboutsection), 'Aboutsection retrieved successfully');
    }

    /**
     * Update the specified Aboutsection in storage.
     * PUT/PATCH /aboutsections/{id}
     *
     * @param int $id
     * @param UpdateAboutsectionAPIRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateAboutsectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Aboutsection $aboutsection */
        $aboutsection = $this->aboutsectionRepository->find($id);

        if (empty($aboutsection)) {
            return $this->sendError('Aboutsection not found');
        }

        $aboutsection = $this->aboutsectionRepository->update($input, $id);

        return $this->sendResponse(new AboutsectionResource($aboutsection), 'Aboutsection updated successfully');
    }

    /**
     * Remove the specified Aboutsection from storage.
     * DELETE /aboutsections/{id}
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Aboutsection $aboutsection */
        $aboutsection = $this->aboutsectionRepository->find($id);

        if (empty($aboutsection)) {
            return $this->sendError('Aboutsection not found');
        }

        $aboutsection->delete();

        return $this->sendSuccess('Aboutsection deleted successfully');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public static function aboutsection()
    {
        return Aboutsection::with(
            'social'
            , 'lowerBox'
            , 'imageBox'
        )->latest()->first();
    }
}
