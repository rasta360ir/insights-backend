<?php

namespace App\Http\Controllers\Insights;

use App\Http\Controllers\Controller;
use App\Http\Requests\Insights\ContactForm\StoreContactFormRequest;
use App\Models\ContactForm;
use Illuminate\Http\JsonResponse;

class ContactFormController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContactFormRequest $request
     * @return JsonResponse
     */
    public function store(StoreContactFormRequest $request): JsonResponse
    {
        $data = $request->validated();

        $contactForm = ContactForm::query()->create($data);

        return response()->json($contactForm, 201);
    }
}
