<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\StoreNewsRequest;
use App\Http\Requests\Admin\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $news = News::query()->latest('id')->get();
        return response()->json($news);
    }

    /**
     * Store a newly created news in storage.
     *
     * @param StoreNewsRequest $request
     * @return JsonResponse
     */
    public function store(StoreNewsRequest $request): JsonResponse
    {
        $data = $request->validated();

        $news = News::query()->create($data);

        return response()->json($news, 201);
    }

    /**
     * Display the specified news.
     *
     * @param News $news
     * @return JsonResponse
     */
    public function show(News $news): JsonResponse
    {
        return response()->json($news);
    }

    /**
     * Update the specified news in storage.
     *
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return JsonResponse
     */
    public function update(UpdateNewsRequest $request, News $news): JsonResponse
    {
        $data = $request->validated();

        $news->update($data);

        return response()->json($news);
    }

    /**
     * Soft Delete the specified news from storage.
     *
     * @param News $news
     * @return JsonResponse
     */
    public function destroy(News $news): JsonResponse
    {
        $news->delete();

        return response()->json(null);
    }

    /**
     * Restore the specified news from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $result = News::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified news from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $result = News::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
