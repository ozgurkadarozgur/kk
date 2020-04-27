<?php

namespace App\Http\Resources\Order;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'total' => $this->total,
            'address' => $this->address,
            'items' => OrderItemResource::collection($this->items),
            'created_at' => Carbon::parse($this->created_at)->isoFormat('LL'),
        ];
    }
}
