<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateBlogpagAPIRequest;
use App\Http\Requests\API\UpdateBlogpagAPIRequest;
use App\Http\Resources\BlogpagResource;
use App\Models\Parlamento\Blogpag;
use App\Repositories\Parlamento\BlogpagRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class BlogpagController
 * @package App\Http\Controllers\API
 */
class BlogpagAPIController extends AppBaseController
{
    /** @var  \App\Repositories\Parlamento\BlogpagRepository */
    private $blogpagRepository;

    public function __construct(BlogpagRepository $blogpagRepo)
    {
        $this->blogpagRepository = $blogpagRepo;
    }

    /**
     * Display a listing of the Blogpag.
     * GET|HEAD /blogpags
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $blogpags = Blogpag::with('multipleItems'
            , 'categories'
            , 'categories.items'
            , 'posts'
            , 'posts.items'
        )->latest()->first();

        return $this->sendResponse($blogpags, 'Blogpags retrieved successfully');
    }

    /**
     * Store a newly created Blogpag in storage.
     * POST /blogpags
     *
     * @param CreateBlogpagAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBlogpagAPIRequest $request)
    {
        $input = $request->all();

        $blogpag = $this->blogpagRepository->create($input);

        return $this->sendResponse(new BlogpagResource($blogpag), 'Blogpag saved successfully');
    }

    /**
     * Display the specified Blogpag.
     * GET|HEAD /blogpags/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var \App\Models\Parlamento\Blogpag $blogpag */
        $blogpag = $this->blogpagRepository->find($id);

        if (empty($blogpag)) {
            return $this->sendError('Blogpag not found');
        }

        return $this->sendResponse(new BlogpagResource($blogpag), 'Blogpag retrieved successfully');
    }

    /**
     * Update the specified Blogpag in storage.
     * PUT/PATCH /blogpags/{id}
     *
     * @param int $id
     * @param UpdateBlogpagAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBlogpagAPIRequest $request)
    {
        $input = $request->all();

        /** @var \App\Models\Parlamento\Blogpag $blogpag */
        $blogpag = $this->blogpagRepository->find($id);

        if (empty($blogpag)) {
            return $this->sendError('Blogpag not found');
        }

        $blogpag = $this->blogpagRepository->update($input, $id);

        return $this->sendResponse(new BlogpagResource($blogpag), 'Blogpag updated successfully');
    }

    /**
     * Remove the specified Blogpag from storage.
     * DELETE /blogpags/{id}
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        /** @var \App\Models\Parlamento\Blogpag $blogpag */
        $blogpag = $this->blogpagRepository->find($id);

        if (empty($blogpag)) {
            return $this->sendError('Blogpag not found');
        }

        $blogpag->delete();

        return $this->sendSuccess('Blogpag deleted successfully');
    }

    public static function blogPag()
    {
        return Blogpag::with('multipleItems'
            , 'categories'
            , 'categories.items'
            , 'posts'
            , 'posts.items'
        )->latest()->first();
    }
}
