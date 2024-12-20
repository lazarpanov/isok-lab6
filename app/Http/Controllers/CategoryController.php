<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Illuminate\View\Factory;
use Illuminate\View\View;
use PHPUnit\TextUI\Application;

class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = $this->categoryRepository->all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryRequest $request): CategoryResource
    {
        // Retrieve validated data
        $data = $request->validated();

        $category = $this->categoryRepository->create($data);

        return CategoryResource::make($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): CategoryResource
    {
        $category = $this->categoryRepository->find($id);
        return CategoryResource::make($category);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, string $id)
    {
        $data = $request->validated();
        $category = $this->categoryRepository->find($id);
        $category = $this->categoryRepository->update($category, $data);
        return CategoryResource::make($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $category = $this->categoryRepository->find($id);
        $this->categoryRepository->delete($category);

        return response()->json(null, 204);
    }
}
