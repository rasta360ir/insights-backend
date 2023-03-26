<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Website\StoreWebsiteRequest;
use App\Http\Requests\Admin\Website\UpdateWebsiteRequest;
use App\Models\Organization;
use App\Models\Website;
use Illuminate\Http\JsonResponse;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the websites.
     *
     * @param Organization  $organization
     * @return JsonResponse
     */
    public function index(Organization $organization): JsonResponse
    {
        return response()->json($organization->websites);
    }

    /**
     * Store a newly created website in storage.
     *
     * @param  StoreWebsiteRequest  $request
     * @param Organization  $organization
     * @return JsonResponse
     */
    public function store(StoreWebsiteRequest $request, Organization $organization): JsonResponse
    {
        $data = $request->validated();

        $website = $organization->websites()->create($data);

        return response()->json($website, 201);
    }

    /**
     * Display the specified website.
     *
     * @param Organization $organization
     * @param  Website  $website
     * @return JsonResponse
     */
    public function show(Organization $organization, Website $website): JsonResponse
    {
        return response()->json($website);
    }

    /**
     * Update the specified website in storage.
     *
     * @param  UpdateWebsiteRequest  $request
     * @param  Organization  $organization
     * @param  Website  $website
     * @return JsonResponse
     */
    public function update(UpdateWebsiteRequest $request, Organization $organization, Website $website): JsonResponse
    {
        $data = $request->validated();

        $website->update($data);

        return response()->json($website);
    }

    /**
     * Soft delete the specified website from storage.
     *
     * @param  Organization  $organization
     * @param  Website  $website
     * @return JsonResponse
     */
    public function destroy(Organization $organization, Website $website): JsonResponse
    {
        $website->delete();

        return response()->json(null);
    }

    /**
     * Restore the specified website from storage.
     *
     * @param Organization  $organization
     * @param int  $id
     * @return JsonResponse
     */
    public function restore(Organization $organization, int $id): JsonResponse
    {
        $result = Website::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified website from storage.
     *
     * @param Organization  $organization
     * @param int  $id
     * @return JsonResponse
     */
    public function remove(Organization $organization, int $id): JsonResponse
    {
        $result = Website::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
