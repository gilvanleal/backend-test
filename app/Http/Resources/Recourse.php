<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Item as ItemRecourse;


class Recourse extends JsonResource
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
            'item_id' => $this->item->id,
            'item_name' => $this->item_name,
            'item_point' => $this->item_point,
            'amount' => $this->amount,
            //'points' => $this->points,
            // 'item' => new ItemRecourse($this->item),
            'links' => [
                'self' => route('recourse.show', $this->id),
                'item_url' => route('item.show', $this->item->id),
            ],
        ];
    }
}
