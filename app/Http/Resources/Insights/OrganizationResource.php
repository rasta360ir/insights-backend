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
            'description' => $this->description,
            'num_employees' => $this->num_employees,
            'image_url' =>  $path . $this->image_url,
            'visits_count' => $this->visits_count,
            'province' => $this->province,
            'city' => $this->city,
            'categories' => $this->categories,
        ];
    }
}
