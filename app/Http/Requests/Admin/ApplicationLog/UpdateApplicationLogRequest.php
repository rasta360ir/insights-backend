<?php

namespace App\Http\Requests\Admin\ApplicationLog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationLogRequest extends FormRequest
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
            'application_id' => ['required', 'integer'],
            'downloads' => ['required', 'integer', 'numeric'],
            'rate' => ['nullable', 'numeric', 'between:0,5.0'],
            'votes' => ['nullable', 'integer'],
            'version' => ['nullable', 'string'],
            'registered_at' => ['required', 'digits_between:1,15'],
        ];
    }
}
