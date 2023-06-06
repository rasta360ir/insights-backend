<?php

namespace App\Http\Resources\Insights;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $path = \URL::to('/');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'legal_title' => $this->legal_title,
            'known_as' => $this->known_as,
            'parent' => $this->parent,
            'status' => $this->status,
            'type' => $this->type,
            'profile_type' => $this->profile_type,
            'ownership_type' => $this->ownership_type,
            'business_model' => $this->business_model,
            'ipo' => $this->ipo,
            'num_employees' => $this->num_employees,
            'description' => $this->description,
            'body' => $this->body,
            'phone' => $this->phone,
            'email' => $this->email,
            'province' => $this->province,
            'city' => $this->city,
            'primary_address' => $this->primary_address,
            'secondary_address' => $this->secondary_address,
            'founded_year' => $this->founded_year,
            'founded_month' => $this->founded_month,
            'founded_day' => $this->founded_day,
            'registered_year' => $this->registered_year,
            'registered_month' => $this->registered_month,
            'registered_day' => $this->registered_day,
            'closed_year' => $this->closed_year,
            'closed_month' => $this->closed_month,
            'closed_day' => $this->closed_day,
            'image_url' =>  $path . $this->image_url,

            'visits_count' => $this->visits_count,
            'categories' => $this->categories,
        ];
    }
}
