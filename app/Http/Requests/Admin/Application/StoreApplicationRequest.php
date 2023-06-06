<?php

namespace App\Http\Requests\Admin\Application;

use App\Models\Application;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicationRequest extends FormRequest
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
            'organization_id' => ['required', 'integer', 'exists:organizations,id'],
            'platform' => ['required', 'string', 'max:255', Rule::in(array_keys(Application::getPlatforms()))],
            'url' => ['required', 'string', 'max:255', 'unique:applications'],
        ];
    }
}
