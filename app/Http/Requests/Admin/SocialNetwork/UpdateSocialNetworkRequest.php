<?php

namespace App\Http\Requests\Admin\SocialNetwork;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialNetworkRequest extends FormRequest
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
            'platform' => ['required', 'string', 'max:20'],
            'url' => ['required', 'string', 'max:255'],
        ];
    }
}
