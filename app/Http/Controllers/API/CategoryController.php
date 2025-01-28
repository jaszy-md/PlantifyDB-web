<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $categories = Category::with('plants')->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Category successfully created',
            'data'    => new CategoryResource($category),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category->load('plants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $validated = $request->validated();

        $category->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Category successfully updated',
            'data'    => new CategoryResource($category),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Category successfully deleted',
        ]);
    }
}
