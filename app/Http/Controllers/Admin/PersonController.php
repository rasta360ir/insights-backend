<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Person\StorePersonRequest;
use App\Http\Requests\Admin\Person\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    /**
     * Display a listing of the people.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $people = Person::query()
            ->latest('id')
            ->get();

        return response()->json($people);
    }

    /**
     * Store a newly created person in storage.
     *
     * @param StorePersonRequest $request
     * @return JsonResponse
     */
    public function store(StorePersonRequest $request): JsonResponse
    {
        $data = $request->validated();

        $person = Person::query()->create($data);

        return response()->json($person, 201);
    }

    /**
     * Display the specified person.
     *
     * @param Person $person
     * @return JsonResponse
     */
    public function show(Person $person): JsonResponse
    {
        return response()->json($person);
    }

    /**
     * Update the specified person in storage.
     *
     * @param UpdatePersonRequest $request
     * @param Person $person
     * @return JsonResponse
     */
    public function update(UpdatePersonRequest $request, Person $person): JsonResponse
    {
        $data = $request->validated();

        $person->update($data);

        return response()->json($person);
    }

    /**
     * Soft delete the specified person from storage.
     *
     * @param Person $person
     * @return JsonResponse
     */
    public function destroy(Person $person): JsonResponse
    {
        $person->delete();

        return response()->json(null);
    }

    /**
     *  Restore the specified person from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $result = Person::withTrashed()->findOrFail($id)->restore();

        return response()->json($result);
    }

    /**
     * Remove the specified person from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function remove(int $id): JsonResponse
    {
        $result = Person::withTrashed()->findOrFail($id)->forceDelete();

        return response()->json($result);
    }
}
