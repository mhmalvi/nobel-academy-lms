<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseUnitCollection extends ResourceCollection
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
            'data' => $this->collection->map(function($res){
                $data = [
                    'Id' => $res->id,
                    'Type' => $res->unit_type,
                    'Code' => $res->unit_code,
                    'Unit' => $res->unit_name,
                    'Course' => $res->course->course_name,
                    'Created' => $res->created_at
                ];

                return $data;
            })
        ];
    }
}
