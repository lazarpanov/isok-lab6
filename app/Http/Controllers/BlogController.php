<?php

namespace App\Http\Controllers;

use App\Http\Requests\blogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\BlogRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected BlogRepository $blogRepository;
    public function __construct(BlogRepository $blogRepository) {
        $this->blogRepository = $blogRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogRepository->all();
        return BlogResource::collection($blogs);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(blogRequest $request)
    {
        $data = $request->validated();
        $blog = $this->blogRepository->create($data);
        return BlogResource::make($blog);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog= $this->blogRepository->find($id);
        return BlogResource::make($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(blogRequest $request, string $id)
    {
        $data= $request->validated();
        $blog = $this->blogRepository->find($id);
        $blog = $this->blogRepository->update($blog, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $blog = $this->blogRepository->find($id);
        $this->blogRepository->delete($blog);
        return response()->json(null, 204);
    }
}
