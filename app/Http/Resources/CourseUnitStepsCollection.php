<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseUnitStepsCollection extends ResourceCollection
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
                    'Step' => $res->step_name,
                    'Created' => $res->created_at
                ];

                return $data;
            }),
            'status' =>200
        ];
    }
}
