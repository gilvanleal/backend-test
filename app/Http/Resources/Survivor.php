<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Recourse as RecourseResource;

class Survivor extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender,
            'is_infected' => $this->is_infected,
            'location' => $this->location,
            'inventory' => RecourseResource::collection($this->recourses),
            'links' => [
                'self' => route('survivor.show', $this->id),
            ],
        ];
    }
}
