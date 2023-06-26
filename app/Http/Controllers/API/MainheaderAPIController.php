<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Publish\MenuAPIController;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateMainheaderAPIRequest;
use App\Http\Requests\API\UpdateMainheaderAPIRequest;
use App\Http\Resources\MainheaderResource;
use App\Models\Parlamento\Mainheader;
use App\Repositories\Parlamento\MainheaderRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MainheaderController
 * @package App\Http\Controllers\API
 */
class MainheaderAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\MainheaderRepository */
    private $mainheaderRepository;

    public function __construct(MainheaderRepository $mainheaderRepo)
    {
        $this->mainheaderRepository = $mainheaderRepo;
    }

    /**
     * Display a listing of the Mainheader.
     * GET|HEAD /mainheaders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mainheaders = $this->mainheaderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MainheaderResource::collection($mainheaders), 'Mainheaders retrieved successfully');
    }

    /**
     * Store a newly created Mainheader in storage.
     * POST /mainheaders
     *
     * @param CreateMainheaderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMainheaderAPIRequest $request)
    {
        $input = $request->all();

        $mainheader = $this->mainheaderRepository->create($input);

        MenuAPIController::publish();

        return $this->sendResponse(new MainheaderResource($mainheader), 'Mainheader saved successfully');
    }

    /**
     * Display the specified Mainheader.
     * GET|HEAD /mainheaders/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Mainheader $mainheader */
        $mainheader = $this->mainheaderRepository->find($id);

        if (empty($mainheader)) {
            return $this->sendError('Mainheader not found');
        }

        return $this->sendResponse(new MainheaderResource($mainheader), 'Mainheader retrieved successfully');
    }

    /**
     * Update the specified Mainheader in storage.
     * PUT/PATCH /mainheaders/{id}
     *
     * @param int $id
     * @param UpdateMainheaderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainheaderAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Mainheader $mainheader */
        $mainheader = $this->mainheaderRepository->find($id);

        if (empty($mainheader)) {
            return $this->sendError('Mainheader not found');
        }

        $mainheader = $this->mainheaderRepository->update($input, $id);

        return $this->sendResponse(new MainheaderResource($mainheader), 'Mainheader updated successfully');
    }

    /**
     * Remove the specified Mainheader from storage.
     * DELETE /mainheaders/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Mainheader $mainheader */
        $mainheader = $this->mainheaderRepository->find($id);

        if (empty($mainheader)) {
            return $this->sendError('Mainheader not found');
        }

        $mainheader->delete();

        return $this->sendSuccess('Mainheader deleted successfully');
    }

    public static function getHeaderContents()
    {
        return Mainheader::with('socialitesList'
            , 'inforList'
            , 'linksBox'
            , 'listLange'
        )->latest()->first();
    }
}
