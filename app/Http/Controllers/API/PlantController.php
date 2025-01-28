<?php

namespace App\Http\Controllers\API;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Plants\PlantResource;
use App\Http\Requests\Plants\StorePlantRequest;
use App\Http\Requests\Plants\UpdatePlantRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
    {
        $query = Plant::query()->with('categories');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('category_ids')) {
            $categoryIds = $request->input('category_ids');
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('id', $categoryIds);
            });
        }

        $plants = $query->get();

        return PlantResource::collection($plants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $plant = Plant::create($validated);

        if ($request->has('category_ids')) {
            $plant->categories()->sync($request->input('category_ids'));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Plant successfully created',
            'data'    => new PlantResource($plant->load('categories')),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant): PlantResource
    {
        return new PlantResource($plant->load('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, Plant $plant): JsonResponse
    {
        $validated = $request->validated();

        $plant->update($validated);

        if ($request->has('category_ids')) {
            $plant->categories()->sync($request->input('category_ids'));
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Plant successfully updated',
            'data'    => new PlantResource($plant->load('categories')),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant): JsonResponse
    {
        $plant->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Plant successfully deleted',
        ]);
    }
}
