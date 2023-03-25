<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organization\StoreOrganizationRequest;
use App\Http\Requests\Admin\Organization\UpdateOrganizationRequest;
use App\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the organizations.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $organizations = Organization::query()
            ->latest('id')
            ->with(['province', 'city'])
            ->get();

        return response()->json($organizations);
    }

    /**
     * Store a newly created organization in storage.
     *
     * @param StoreOrganizationRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrganizationRequest $request): JsonResponse
    {
        $data = $request->validated();

        $organization = Organization::query()->create($data);

        return response()->json($organization, 201);
    }

    /**
     * Display the specified organization.
     *
     * @param Organization $organization
     * @return JsonResponse
     */
    public function show(Organization $organization): JsonResponse
    {
        return response()->json($organization);
    }

    /**
     * Update the specified organization in storage.
     *
     * @param UpdateOrganizationRequest $request
     * @param Organization $organization
     * @return JsonResponse
     */
    public function update(UpdateOrganizationRequest $request, Organization $organization): JsonResponse
    {
        $data = $request->validated();

        $organization->update($data);

        return response()->json($organization);
    }

    /**
     * Soft delete the specified organization from storage.
     *
     * @param Organization $organization
     * @return JsonResponse
     */
    public function destroy(Organization $organization): JsonResponse
    {
        $organization->delete();

        return response()->json(null);
    }

    /**
     *  Restore the specified organization from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $result = Organization::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified organization from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $result = Organization::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
