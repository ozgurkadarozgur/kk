<?php

namespace App\Http\Resources\EliminationLevel;

use App\Http\Resources\EliminationMatch\EliminationMatchResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EliminationLevelResource extends JsonResource
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
            'title' => $this->title,
            'order' => $this->order,
            'is_over' => $this->is_over,
            'matches' => EliminationMatchResource::collection($this->matches),
        ];
    }
}
