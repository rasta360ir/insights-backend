<?php

namespace App\Http\Requests\Admin\Hub;

use Illuminate\Foundation\Http\FormRequest;

class StoreHubRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/([A-Za-z0-9])\w+/u', 'unique:hubs'],
        ];
    }
}
