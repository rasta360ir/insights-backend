<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebsiteLog\StoreWebsiteLogRequest;
use App\Http\Requests\Admin\WebsiteLog\UpdateWebsiteLogRequest;
use App\Models\Website;
use App\Models\WebsiteLog;
use Illuminate\Http\JsonResponse;

class WebsiteLogController extends Controller
{
    /**
     * Display a listing of the websites.
     *
     * @param Website $website
     * @return JsonResponse
     */
    public function index(Website $website): JsonResponse
    {
        return response()->json($website->websiteLogs()->get());
    }

    /**
     * Store a newly created website in storage.
     *
     * @param StoreWebsiteLogRequest $request
     * @param Website $website
     * @return JsonResponse
     */
    public function store(StoreWebsiteLogRequest $request, Website $website): JsonResponse
    {
        $data = $request->validated();

        $websiteLog = $website->websiteLogs()->create($data);

        return response()->json($websiteLog, 201);
    }

    /**
     * Display the specified website.
     *
     * @param Website $website
     * @param WebsiteLog $websiteLog
     * @return JsonResponse
     */
    public function show(Website $website, WebsiteLog $websiteLog): JsonResponse
    {
        return response()->json($websiteLog);
    }

    /**
     * Update the specified website in storage.
     *
     * @param UpdateWebsiteLogRequest $request
     * @param Website $website
     * @param WebsiteLog $websiteLog
     * @return JsonResponse
     */
    public function update(UpdateWebsiteLogRequest $request, Website $website, WebsiteLog $websiteLog): JsonResponse
    {
        $data = $request->validated();

        $websiteLog->update($data);

        return response()->json($websiteLog);
    }

    /**
     * Soft delete the specified website from storage.
     *
     * @param Website $website
     * @param WebsiteLog $websiteLog
     * @return JsonResponse
     */
    public function destroy(Website $website, WebsiteLog $websiteLog): JsonResponse
    {
        $websiteLog->delete();

        return response()->json(null);
    }
}
