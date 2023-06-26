<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateMainfooterAPIRequest;
use App\Http\Requests\API\UpdateMainfooterAPIRequest;
use App\Http\Resources\MainfooterResource;
use App\Models\Parlamento\Mainfooter;
use App\Repositories\Parlamento\MainfooterRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MainfooterController
 * @package App\Http\Controllers\API
 */
class MainfooterAPIController extends AppBaseController
{
    /** @var  MainfooterRepository */
    private $mainfooterRepository;

    public function __construct(MainfooterRepository $mainfooterRepo)
    {
        $this->mainfooterRepository = $mainfooterRepo;
    }

    /**
     * Display a listing of the Mainfooter.
     * GET|HEAD /mainfooters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $mainfooters = $this->mainfooterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MainfooterResource::collection($mainfooters), 'Mainfooters retrieved successfully');
    }

    /**
     * Store a newly created Mainfooter in storage.
     * POST /mainfooters
     *
     * @param CreateMainfooterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMainfooterAPIRequest $request)
    {
        $input = $request->all();

        $mainfooter = $this->mainfooterRepository->create($input);

        return $this->sendResponse(new MainfooterResource($mainfooter), 'Mainfooter saved successfully');
    }

    /**
     * Display the specified Mainfooter.
     * GET|HEAD /mainfooters/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Mainfooter $mainfooter */
        $mainfooter = $this->mainfooterRepository->find($id);

        if (empty($mainfooter)) {
            return $this->sendError('Mainfooter not found');
        }

        return $this->sendResponse(new MainfooterResource($mainfooter), 'Mainfooter retrieved successfully');
    }

    /**
     * Update the specified Mainfooter in storage.
     * PUT/PATCH /mainfooters/{id}
     *
     * @param int $id
     * @param UpdateMainfooterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMainfooterAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Mainfooter $mainfooter */
        $mainfooter = $this->mainfooterRepository->find($id);

        if (empty($mainfooter)) {
            return $this->sendError('Mainfooter not found');
        }

        $mainfooter = $this->mainfooterRepository->update($input, $id);

        return $this->sendResponse(new MainfooterResource($mainfooter), 'Mainfooter updated successfully');
    }

    /**
     * Remove the specified Mainfooter from storage.
     * DELETE /mainfooters/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var Mainfooter $mainfooter */
        $mainfooter = $this->mainfooterRepository->find($id);

        if (empty($mainfooter)) {
            return $this->sendError('Mainfooter not found');
        }

        $mainfooter->delete();

        return $this->sendSuccess('Mainfooter deleted successfully');
    }

    public static function mainFooter()
    {
        return Mainfooter::with('gruParliamentary'
            , 'location'
            , 'responsible'

        )->latest()->first();
    }
}
