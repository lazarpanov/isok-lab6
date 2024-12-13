<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Factory;
use Illuminate\View\View;
use PHPUnit\TextUI\Application;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::query()
            ->when($request->has('search'),
                fn ($query) => $query->where('name', 'like', '%' . request('search') . '%'))->get();
        return view('categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryRequest $request)
    {
        // Retrieve validated data
        $data = $request->validated();

        // Generate slug
        $data['slug'] = Str::slug($data['name']);

        // Create a new category
        Category::query()->create($data);

        // Redirect to the categories index page
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View|Factory|Application
    {
        $category->load('blogs');
        return view('categories/show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories/edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(categoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->blogs()->delete();
        $category->delete();
        return redirect()->route('categories.index');
    }
}
