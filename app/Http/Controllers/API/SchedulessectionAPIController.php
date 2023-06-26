<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateSchedulessectionAPIRequest;
use App\Http\Requests\API\UpdateSchedulessectionAPIRequest;
use App\Http\Resources\SchedulessectionResource;
use App\Models\Parlamento\Schedulessection;
use App\Repositories\Parlamento\SchedulessectionRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class SchedulessectionController
 * @package App\Http\Controllers\API
 */
class SchedulessectionAPIController extends AppBaseController
{
    /** @var  SchedulessectionRepository */
    private $schedulessectionRepository;

    public function __construct(SchedulessectionRepository $schedulessectionRepo)
    {
        $this->schedulessectionRepository = $schedulessectionRepo;
    }

    /**
     * Display a listing of the Schedulessection.
     * GET|HEAD /schedulessections
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = Schedulessection::with('tabbtnslis'
            , 'subscribeInner'
            , 'subscribeInner.history'
            , 'tabsContent'
            , 'tabsContent.tab2'
            , 'tabsContent.tab2.saibaMaisLinks'
            , 'tabsContent.tab2.shareLinks'
            , 'tabsContent.tab2.postDate'
            , 'tabsContent.tab2.postInfo'
            , 'tabsContent.tab3'
            , 'tabsContent.tab3.saibaMaisLinks'
            , 'tabsContent.tab3.shareLinks'
            , 'tabsContent.tab3.postDate'
            , 'tabsContent.tab3.postInfo'
        )->latest()->first();

        $indexDataJSON = json_encode($data, true);

        file_put_contents(base_path('public/json/schedulessection.json'), stripslashes($indexDataJSON));

        return $this->sendResponse($data, 'Schedulessections retrieved successfully');
    }

    /**
     * Store a newly created Schedulessection in storage.
     * POST /schedulessections
     *
     * @param CreateSchedulessectionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSchedulessectionAPIRequest $request)
    {

        $input = $request->all();

        $schedulessection = $this->schedulessectionRepository->create($input);

        return $this->sendResponse(new SchedulessectionResource($schedulessection), 'Schedulessection saved successfully');
    }

    /**
     * Display the specified Schedulessection.
     * GET|HEAD /schedulessections/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Schedulessection $schedulessection */
        $schedulessection = $this->schedulessectionRepository->find($id);

        if (empty($schedulessection)) {
            return $this->sendError('Schedulessection not found');
        }

        return $this->sendResponse(new SchedulessectionResource($schedulessection), 'Schedulessection retrieved successfully');
    }

    /**
     * Update the specified Schedulessection in storage.
     * PUT/PATCH /schedulessections/{id}
     *
     * @param int $id
     * @param UpdateSchedulessectionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSchedulessectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Schedulessection $schedulessection */
        $schedulessection = $this->schedulessectionRepository->find($id);

        if (empty($schedulessection)) {
            return $this->sendError('Schedulessection not found');
        }

        $schedulessection = $this->schedulessectionRepository->update($input, $id);

        return $this->sendResponse(new SchedulessectionResource($schedulessection), 'Schedulessection updated successfully');
    }

    /**
     * Remove the specified Schedulessection from storage.
     * DELETE /schedulessections/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Schedulessection $schedulessection */
        $schedulessection = $this->schedulessectionRepository->find($id);

        if (empty($schedulessection)) {
            return $this->sendError('Schedulessection not found');
        }

        $schedulessection->delete();

        return $this->sendSuccess('Schedulessection deleted successfully');
    }

    public static function schedulesSection()
    {
        return Schedulessection::with(
            'subscribeInner'
            , 'subscribeInner.history'
            , 'tabbtnslis'
        // , 'tabsContent'
        /*, 'tabsContent.tab2'
        , 'tabsContent.tab2.saibaMaisLinks'
        , 'tabsContent.tab2.shareLinks'
        , 'tabsContent.tab2.postDate'
        , 'tabsContent.tab2.postInfo'
        , 'tabsContent.tab3'
        , 'tabsContent.tab3.saibaMaisLinks'
        , 'tabsContent.tab3.shareLinks'
        , 'tabsContent.tab3.postDate'
        , 'tabsContent.tab3.postInfo'*/
        )->first();

    }


}
