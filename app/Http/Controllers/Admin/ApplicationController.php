<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Application\StoreApplicationRequest;
use App\Http\Requests\Admin\Application\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Organization;
use Illuminate\Http\JsonResponse;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the applications.
     *
     * @param Organization $organization
     * @return JsonResponse
     */
    public function index(Organization $organization): JsonResponse
    {
        return response()->json($organization->applications);
    }

    /**
     * Store a newly created application in storage.
     *
     * @param StoreApplicationRequest $request
     * @param Organization $organization
     * @return JsonResponse
     */
    public function store(StoreApplicationRequest $request, Organization $organization): JsonResponse
    {
        $data = $request->validated();

        $application = $organization->applications()->create($data);

        return response()->json($application, 201);
    }

    /**
     * Display the specified application.
     *
     * @param Organization $organization
     * @param Application $application
     * @return JsonResponse
     */
    public function show(Organization $organization, Application $application): JsonResponse
    {
        return response()->json($application);
    }

    /**
     * Update the specified application in storage.
     *
     * @param UpdateApplicationRequest $request
     * @param Organization $organization
     * @param Application $application
     * @return JsonResponse
     */
    public function update(UpdateApplicationRequest $request, Organization $organization, Application $application): JsonResponse
    {
        $data = $request->validated();

        $application->update($data);

        return response()->json($application);
    }

    /**
     * Soft Delete the specified application from storage.
     *
     * @param Organization $organization
     * @param Application $application
     * @return JsonResponse
     */
    public function destroy(Organization $organization, Application $application): JsonResponse
    {
        $application->delete();

        return response()->json(null);
    }

    /**
     * Restore the specified application from storage.
     *
     * @param Organization $organization
     * @param int $id
     * @return JsonResponse
     */
    public function restore(Organization $organization, int $id): JsonResponse
    {
        $result = Application::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified application from storage.
     *
     * @param Organization $organization
     * @param int $id
     * @return JsonResponse
     */
    public function remove(Organization $organization, int $id): JsonResponse
    {
        $result = Application::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
