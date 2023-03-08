<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\StoreDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $departments = Department::orderBy('id', 'ASC')->get();
        return response()->json($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDepartmentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDepartmentRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $department = Department::create($data);

        return response()->json($department, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Department $department): \Illuminate\Http\JsonResponse
    {
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDepartmentRequest  $request
     * @param  Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $department->update($data);

        return response()->json($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Department  $department
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Department $department): \Illuminate\Http\JsonResponse
    {
        $department->delete();

        return response()->json(null);
    }
}
