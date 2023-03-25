<?php

namespace App\Http\Requests\Admin\Organization;

use App\Models\City;
use App\Models\Organization;
use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrganizationRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:255', 'regex:/([A-Za-z0-9])\w+/u', 'unique:organizations'],
            'legal_title' => ['nullable', 'string', 'max:255'],
            'known_as' => ['nullable', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:organizations,id'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['required', 'integer', 'exists:categories,id'],
            'status' => ['nullable', 'string', 'max:255', Rule::in(array_keys(Organization::getStatuses()))],
            'type' => ['nullable', 'string', 'max:255', Rule::in(array_keys(Organization::getTypes()))],
            'profile_type' => ['nullable', 'string', 'max:255', Rule::in(array_keys(Organization::getProfileTypes()))],
            'ownership_type' => ['nullable', 'string', 'max:255', Rule::in(array_keys(Organization::getOwnershipTypes()))],
            'business_model' => ['nullable', 'string', 'max:255', Rule::in(Organization::getBusinessModels())],
            'ipo' => ['nullable', 'string', 'max:255', Rule::in(array_keys(Organization::getIpoStatuses()))],
            'num_employees' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable'],
            'body' => ['nullable'],
            'phone' => ['nullable', 'max:255'],
            'email' => ['nullable', 'max:255'],
            'province_id' => ['nullable', 'integer', Rule::in(Province::query()->get()->pluck('id')->toArray())],
            'city_id' => ['nullable', 'integer', Rule::in(City::query()->get()->pluck('id')->toArray())],
            'primary_address' => ['nullable', 'max:255'],
            'secondary_address' => ['nullable', 'max:255'],
            'founded_year' => ['nullable', 'integer', 'between:1300,' . jdate(now())->format('Y')],
            'founded_month' => ['nullable', 'integer', 'between:1,12'],
            'founded_day' => ['nullable', 'integer', 'between:1,31'],
            'registered_year' => ['nullable', 'integer', 'between:1300,' . jdate(now())->format('Y')],
            'registered_month' => ['nullable', 'integer', 'between:1,12'],
            'registered_day' => ['nullable', 'integer', 'between:1,31'],
            'closed_year' => ['nullable', 'integer', 'between:1300,' . jdate(now())->format('Y')],
            'closed_month' => ['nullable', 'integer', 'between:1,12'],
            'closed_day' => ['nullable', 'integer', 'between:1,31'],
            'imageUrl' => ['nullable', 'image'],
        ];
    }
}
