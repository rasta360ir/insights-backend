<?php

namespace App\Http\Requests\Admin\WebsiteLog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWebsiteLogRequest extends FormRequest
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
            'website_id' => ['required', 'integer', 'exists:websites,id'],
            'visits' => ['required', 'integer', 'max:255'],
            'year' => ['required', 'integer', 'between:1900,' . now()->format('Y')],
            'month' => ['required', 'integer', 'between:1,12'],
        ];
    }
}
