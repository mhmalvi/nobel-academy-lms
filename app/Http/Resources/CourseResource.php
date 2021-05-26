<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseResource extends ResourceCollection
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
                    'UniqueId' => $res->id,
                    'Code' => $res->code,
                    'Course' => $res->name,
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
