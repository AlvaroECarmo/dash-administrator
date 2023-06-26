<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateSliderinfoAPIRequest;
use App\Http\Requests\API\UpdateSliderinfoAPIRequest;
use App\Http\Resources\SliderinfoResource;
use App\Models\Parlamento\Sliderinfo;
use App\Repositories\Parlamento\SliderinfoRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class SliderinfoController
 * @package App\Http\Controllers\API
 */
class SliderinfoAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\SliderinfoRepository */
    private $sliderinfoRepository;

    public function __construct(SliderinfoRepository $sliderinfoRepo)
    {
        $this->sliderinfoRepository = $sliderinfoRepo;
    }

    /**
     * Display a listing of the Sliderinfo.
     * GET|HEAD /sliderinfos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $sliderinfos = $this->sliderinfoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(SliderinfoResource::collection($sliderinfos), 'Sliderinfos retrieved successfully');
    }

    /**
     * Store a newly created Sliderinfo in storage.
     * POST /sliderinfos
     *
     * @param CreateSliderinfoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSliderinfoAPIRequest $request)
    {
        $input = $request->all();

        $sliderinfo = $this->sliderinfoRepository->create($input);

        return $this->sendResponse(new SliderinfoResource($sliderinfo), 'Sliderinfo saved successfully');
    }

    /**
     * Display the specified Sliderinfo.
     * GET|HEAD /sliderinfos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Sliderinfo $sliderinfo */
        $sliderinfo = $this->sliderinfoRepository->find($id);

        if (empty($sliderinfo)) {
            return $this->sendError('Sliderinfo not found');
        }

        return $this->sendResponse(new SliderinfoResource($sliderinfo), 'Sliderinfo retrieved successfully');
    }

    /**
     * Update the specified Sliderinfo in storage.
     * PUT/PATCH /sliderinfos/{id}
     *
     * @param int $id
     * @param UpdateSliderinfoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSliderinfoAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Sliderinfo $sliderinfo */
        $sliderinfo = $this->sliderinfoRepository->find($id);

        if (empty($sliderinfo)) {
            return $this->sendError('Sliderinfo not found');
        }

        $sliderinfo = $this->sliderinfoRepository->update($input, $id);

        return $this->sendResponse(new SliderinfoResource($sliderinfo), 'Sliderinfo updated successfully');
    }

    /**
     * Remove the specified Sliderinfo from storage.
     * DELETE /sliderinfos/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Sliderinfo $sliderinfo */
        $sliderinfo = $this->sliderinfoRepository->find($id);

        if (empty($sliderinfo)) {
            return $this->sendError('Sliderinfo not found');
        }

        $sliderinfo->delete();

        return $this->sendSuccess('Sliderinfo deleted successfully');
    }

    public static function sliderInfo()
    {
        return Sliderinfo::orderBy('id', 'desc')->get()->take(5);

    }
}
