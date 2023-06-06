<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApplicationLog\StoreApplicationLogRequest;
use App\Http\Requests\Admin\ApplicationLog\UpdateApplicationLogRequest;
use App\Models\Application;
use App\Models\ApplicationLog;
use Illuminate\Http\JsonResponse;

class ApplicationLogController extends Controller
{
    /**
     * Display a listing of the applicationLogs.
     *
     * @param Application $application
     * @return JsonResponse
     */
    public function index(Application $application): JsonResponse
    {
        return response()->json($application->applicationLogs()->get());
    }

    /**
     * Store a newly created websiteLog in storage.
     *
     * @param StoreApplicationLogRequest $request
     * @param Application $application
     * @return JsonResponse
     */
    public function store(StoreApplicationLogRequest $request, Application $application): JsonResponse
    {
        $data = $request->validated();

        $applicationLog = $application->applicationLogs()->create($data);

        return response()->json($applicationLog, 201);
    }

    /**
     * Display the specified websiteLog.
     *
     * @param Application $application
     * @param ApplicationLog $applicationLog
     * @return JsonResponse
     */
    public function show(Application $application, ApplicationLog $applicationLog): JsonResponse
    {
        return response()->json($applicationLog);
    }

    /**
     * Update the specified websiteLog in storage.
     *
     * @param UpdateApplicationLogRequest $request
     * @param Application $application
     * @param ApplicationLog $applicationLog
     * @return JsonResponse
     */
    public function update(UpdateApplicationLogRequest $request, Application $application, ApplicationLog $applicationLog): JsonResponse
    {
        $data = $request->validated();

        $applicationLog->update($data);

        return response()->json($applicationLog);
    }

    /**
     * Soft delete the specified websiteLog from storage.
     *
     * @param Application $application
     * @param ApplicationLog $applicationLog
     * @return JsonResponse
     */
    public function destroy(Application $application, ApplicationLog $applicationLog): JsonResponse
    {
        $applicationLog->delete();

        return response()->json(null);
    }
}
