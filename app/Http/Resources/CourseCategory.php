<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCategory extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($res) {
                $data = [
                    'Id' => $res->uuid,
                    'Code' => $res->category_code,
                    'Name' => $res->category_name,
                    'Details' => $res->descriptions,
                    'Created' => $res->created_at
                ];

                return $data;
            }),
            'response' => [
                'status' => 200
            ]
        ];
    }
}
