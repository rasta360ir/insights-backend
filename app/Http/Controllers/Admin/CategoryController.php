<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::head()->with(['subcategories'])->get();

        return response()->json($categories, 200);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $category = Category::query()->create($data);

        return response()->json($category, 201);
    }

    /**
     * Display the specified category.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category, 200);
    }

    /**
     * Update the specified category in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = $request->validated();

        $category->update($data);

        return response()->json($category, 200);
    }

    /**
     * Soft delete the specified category from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(null, 200);
    }

    /**
     * Restore the specified category from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $result = Category::withTrashed()->findOrFail($id)->restore();

        return response()->json($result, 200);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function remove($id): JsonResponse
    {
        $result = Category::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result, 200);
    }
}
