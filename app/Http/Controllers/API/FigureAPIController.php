<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateFigureAPIRequest;
use App\Http\Requests\API\UpdateFigureAPIRequest;
use App\Http\Resources\FigureResource;
use App\Models\Parlamento\Figure;
use App\Repositories\Parlamento\FigureRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class FigureController
 * @package App\Http\Controllers\API
 */

class FigureAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\FigureRepository */
    private $figureRepository;

    public function __construct(FigureRepository $figureRepo)
    {
        $this->figureRepository = $figureRepo;
    }

    /**
     * Display a listing of the Figure.
     * GET|HEAD /figures
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $figures = $this->figureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FigureResource::collection($figures), 'Figures retrieved successfully');
    }

    /**
     * Store a newly created Figure in storage.
     * POST /figures
     *
     * @param CreateFigureAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFigureAPIRequest $request)
    {
        $input = $request->all();

        $figure = $this->figureRepository->create($input);

        return $this->sendResponse(new FigureResource($figure), 'Figure saved successfully');
    }

    /**
     * Display the specified Figure.
     * GET|HEAD /figures/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Figure $figure */
        $figure = $this->figureRepository->find($id);

        if (empty($figure)) {
            return $this->sendError('Figure not found');
        }

        return $this->sendResponse(new FigureResource($figure), 'Figure retrieved successfully');
    }

    /**
     * Update the specified Figure in storage.
     * PUT/PATCH /figures/{id}
     *
     * @param int $id
     * @param UpdateFigureAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFigureAPIRequest $request)
    {
        $input = $request->all();

        /** @var Figure $figure */
        $figure = $this->figureRepository->find($id);

        if (empty($figure)) {
            return $this->sendError('Figure not found');
        }

        $figure = $this->figureRepository->update($input, $id);

        return $this->sendResponse(new FigureResource($figure), 'Figure updated successfully');
    }

    /**
     * Remove the specified Figure from storage.
     * DELETE /figures/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Figure $figure */
        $figure = $this->figureRepository->find($id);

        if (empty($figure)) {
            return $this->sendError('Figure not found');
        }

        $figure->delete();

        return $this->sendSuccess('Figure deleted successfully');
    }
}
