<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateSocialAPIRequest;
use App\Http\Requests\API\UpdateSocialAPIRequest;
use App\Http\Resources\SocialResource;
use App\Models\Parlamento\Social;
use App\Repositories\Parlamento\SocialRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class SocialController
 * @package App\Http\Controllers\API
 */
class SocialAPIController extends AppBaseController
{
    /** @var  SocialRepository */
    private $socialRepository;

    public function __construct(SocialRepository $socialRepo)
    {
        $this->socialRepository = $socialRepo;
    }

    /**
     * Display a listing of the Social.
     * GET|HEAD /socials
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $socials = Social::with('aboutSection')->get();

        /*all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );*/

        return $this->sendResponse($socials, 'Socials retrieved successfully');
    }

    /**
     * Store a newly created Social in storage.
     * POST /socials
     *
     * @param CreateSocialAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSocialAPIRequest $request)
    {
        $input = $request->all();

        $social = $this->socialRepository->create($input);

        return $this->sendResponse(new SocialResource($social), 'Social saved successfully');
    }

    /**
     * Display the specified Social.
     * GET|HEAD /socials/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Social $social */
        $social = $this->socialRepository->find($id);

        if (empty($social)) {
            return $this->sendError('Social not found');
        }

        return $this->sendResponse(new SocialResource($social), 'Social retrieved successfully');
    }

    /**
     * Update the specified Social in storage.
     * PUT/PATCH /socials/{id}
     *
     * @param int $id
     * @param UpdateSocialAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSocialAPIRequest $request)
    {
        $input = $request->all();

        /** @var Social $social */
        $social = $this->socialRepository->find($id);

        if (empty($social)) {
            return $this->sendError('Social not found');
        }

        $social = $this->socialRepository->update($input, $id);

        return $this->sendResponse(new SocialResource($social), 'Social updated successfully');
    }

    /**
     * Remove the specified Social from storage.
     * DELETE /socials/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Social $social */
        $social = $this->socialRepository->find($id);

        if (empty($social)) {
            return $this->sendError('Social not found');
        }

        $social->delete();

        return $this->sendSuccess('Social deleted successfully');
    }
}
