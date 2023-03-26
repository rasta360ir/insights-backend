<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialNetwork\StoreSocialNetworkRequest;
use App\Http\Requests\Admin\SocialNetwork\UpdateSocialNetworkRequest;
use App\Models\Organization;
use App\Models\SocialNetwork;
use Illuminate\Http\JsonResponse;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the socialNetworks.
     *
     * @param Organization $organization
     * @return JsonResponse
     */
    public function index(Organization $organization): JsonResponse
    {
        return response()->json($organization->socialNetworks);
    }

    /**
     * Store a newly created socialNetwork in storage.
     *
     * @param StoreSocialNetworkRequest $request
     * @param Organization $organization
     * @return JsonResponse
     */
    public function store(StoreSocialNetworkRequest $request, Organization $organization): JsonResponse
    {
        $data = $request->validated();

        $socialNetwork = $organization->socialNetworks()->create($data);

        return response()->json($socialNetwork, 201);
    }

    /**
     * Display the specified socialNetwork.
     *
     * @param Organization $organization
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function show(Organization $organization, SocialNetwork $socialNetwork): JsonResponse
    {
        return response()->json($socialNetwork);
    }

    /**
     * Update the specified socialNetwork in storage.
     *
     * @param UpdateSocialNetworkRequest $request
     * @param Organization $organization
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function update(UpdateSocialNetworkRequest $request, Organization $organization, SocialNetwork $socialNetwork): JsonResponse
    {
        $data = $request->validated();

        $socialNetwork->update($data);

        return response()->json($socialNetwork);
    }

    /**
     * Soft delete the specified socialNetwork from storage.
     *
     * @param Organization $organization
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function destroy(Organization $organization, SocialNetwork $socialNetwork): JsonResponse
    {
        $socialNetwork->delete();

        return response()->json(null);
    }

    /**
     * Restore the specified socialNetwork from storage.
     *
     * @param Organization $organization
     * @param int $id
     * @return JsonResponse
     */
    public function restore(Organization $organization, int $id): JsonResponse
    {
        $result = SocialNetwork::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified socialNetwork from storage.
     *
     * @param Organization $organization
     * @param int $id
     * @return JsonResponse
     */
    public function remove(Organization $organization, int $id): JsonResponse
    {
        $result = SocialNetwork::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
