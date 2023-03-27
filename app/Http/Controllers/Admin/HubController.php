<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Hub\StoreHubRequest;
use App\Http\Requests\Admin\Hub\UpdateHubRequest;
use App\Models\Hub;
use Illuminate\Http\JsonResponse;

class HubController extends Controller
{
    /**
     * Display a listing of the hubs.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $hubs = Hub::query()
            ->latest('id')
            ->get();

        return response()->json($hubs);
    }

    /**
     * Store a newly created hub in storage.
     *
     * @param StoreHubRequest $request
     * @return JsonResponse
     */
    public function store(StoreHubRequest $request): JsonResponse
    {
        $data = $request->validated();

        $hub = Hub::query()->create($data);

        return response()->json($hub, 201);
    }

    /**
     * Display the specified hub.
     *
     * @param Hub $hub
     * @return JsonResponse
     */
    public function show(Hub $hub): JsonResponse
    {
        return response()->json($hub);
    }

    /**
     * Update the specified hub in storage.
     *
     * @param UpdateHubRequest $request
     * @param Hub $hub
     * @return JsonResponse
     */
    public function update(UpdateHubRequest $request, Hub $hub): JsonResponse
    {
        $data = $request->validated();

        $hub->update($data);

        return response()->json($hub);
    }

    /**
     * Soft delete the specified hub from storage.
     *
     * @param Hub $hub
     * @return JsonResponse
     */
    public function destroy(Hub $hub): JsonResponse
    {
        $hub->delete();

        return response()->json(null);
    }

    /**
     *  Restore the specified hub from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $result = Hub::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified hub from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $result = Hub::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
