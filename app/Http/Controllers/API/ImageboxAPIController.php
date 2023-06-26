<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateImageboxAPIRequest;
use App\Http\Requests\API\UpdateImageboxAPIRequest;
use App\Http\Resources\ImageboxResource;
use App\Repositories\Parlamento\ImageboxRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ImageboxController
 * @package App\Http\Controllers\API
 */

class ImageboxAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\ImageboxRepository */
    private $imageboxRepository;

    public function __construct(ImageboxRepository $imageboxRepo)
    {
        $this->imageboxRepository = $imageboxRepo;
    }

    /**
     * Display a listing of the Imagebox.
     * GET|HEAD /imageboxes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $imageboxes = $this->imageboxRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ImageboxResource::collection($imageboxes), 'Imageboxes retrieved successfully');
    }

    /**
     * Store a newly created Imagebox in storage.
     * POST /imageboxes
     *
     * @param CreateImageboxAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateImageboxAPIRequest $request)
    {
        $input = $request->all();

        $imagebox = $this->imageboxRepository->create($input);

        return $this->sendResponse(new ImageboxResource($imagebox), 'Imagebox saved successfully');
    }

    /**
     * Display the specified Imagebox.
     * GET|HEAD /imageboxes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Imagebox $imagebox */
        $imagebox = $this->imageboxRepository->find($id);

        if (empty($imagebox)) {
            return $this->sendError('Imagebox not found');
        }

        return $this->sendResponse(new ImageboxResource($imagebox), 'Imagebox retrieved successfully');
    }

    /**
     * Update the specified Imagebox in storage.
     * PUT/PATCH /imageboxes/{id}
     *
     * @param int $id
     * @param UpdateImageboxAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateImageboxAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Imagebox $imagebox */
        $imagebox = $this->imageboxRepository->find($id);

        if (empty($imagebox)) {
            return $this->sendError('Imagebox not found');
        }

        $imagebox = $this->imageboxRepository->update($input, $id);

        return $this->sendResponse(new ImageboxResource($imagebox), 'Imagebox updated successfully');
    }

    /**
     * Remove the specified Imagebox from storage.
     * DELETE /imageboxes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Imagebox $imagebox */
        $imagebox = $this->imageboxRepository->find($id);

        if (empty($imagebox)) {
            return $this->sendError('Imagebox not found');
        }

        $imagebox->delete();

        return $this->sendSuccess('Imagebox deleted successfully');
    }
}
