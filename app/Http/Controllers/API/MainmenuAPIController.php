<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateMainmenuAPIRequest;
use App\Http\Requests\API\UpdateMainmenuAPIRequest;
use App\Http\Resources\MainmenuResource;
use App\Models\Parlamento\Mainmenu;
use App\Repositories\Parlamento\MainmenuRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MainmenuController
 * @package App\Http\Controllers\API
 */
class MainmenuAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\MainmenuRepository */
    private $mainmenuRepository;

    public function __construct(MainmenuRepository $mainmenuRepo)
    {
        $this->mainmenuRepository = $mainmenuRepo;
    }

    /**
     * Display a listing of the Mainmenu.
     * GET|HEAD /mainmenus
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mainmenus = $this->mainmenuRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MainmenuResource::collection($mainmenus), 'Mainmenus retrieved successfully');
    }

    /**
     * Store a newly created Mainmenu in storage.
     * POST /mainmenus
     *
     * @param CreateMainmenuAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMainmenuAPIRequest $request)
    {
        $input = $request->all();

        $mainmenu = $this->mainmenuRepository->create($input);

        return $this->sendResponse(new MainmenuResource($mainmenu), 'Mainmenu saved successfully');
    }

    /**
     * Display the specified Mainmenu.
     * GET|HEAD /mainmenus/{id}
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /** @var Mainmenu $mainmenu */
        $mainmenu = $this->mainmenuRepository->find($id);

        if (empty($mainmenu)) {
            return $this->sendError('Mainmenu not found');
        }

        return $this->sendResponse(new MainmenuResource($mainmenu), 'Mainmenu retrieved successfully');
    }

    /**
     * Update the specified Mainmenu in storage.
     * PUT/PATCH /mainmenus/{id}
     *
     * @param int $id
     * @param UpdateMainmenuAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainmenuAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Mainmenu $mainmenu */
        $mainmenu = $this->mainmenuRepository->find($id);

        if (empty($mainmenu)) {
            return $this->sendError('Mainmenu not found');
        }

        $mainmenu = $this->mainmenuRepository->update($input, $id);

        return $this->sendResponse(new MainmenuResource($mainmenu), 'Mainmenu updated successfully');
    }

    /**
     * Remove the specified Mainmenu from storage.
     * DELETE /mainmenus/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Mainmenu $mainmenu */
        $mainmenu = $this->mainmenuRepository->find($id);

        if (empty($mainmenu)) {
            return $this->sendError('Mainmenu not found');
        }

        $mainmenu->delete();

        return $this->sendSuccess('Mainmenu deleted successfully');
    }

    public static function menuMain()
    {
        // with('elements')->get()->take(6)->where('elements', [])
        return Mainmenu::where('elements', null)->with('elements.elements')->orderBy('ordem')->get()->take(7);
    }

    public static function menuMainfull()
    {
        // with('elements')->get()->take(6)->where('elements', [])
        return Mainmenu::where('elements', null)->with('elements.elements')->get();
    }
}
