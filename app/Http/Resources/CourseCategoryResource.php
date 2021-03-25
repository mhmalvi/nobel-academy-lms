<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'Id' => $this->uuid,
                'Code' => $this->category_code,
                'Name' => $this->category_name,
                'Details' => $this->descriptions,
                'Created' => $this->created_at
            ],
            'status' => 200
        ];
    }
}
