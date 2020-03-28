<?php

namespace App\Http\Resources\Elimination;

use App\Http\Resources\EliminationApplication\EliminationApplicationResource;
use App\Http\Resources\EliminationLevel\EliminationLevelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EliminationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_started' => $this->is_started,
            'type' => 'Eleme',
            'facility' => $this->facility->title,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'max_team_count' => $this->max_team_count,
            'min_player_count' => $this->min_player_count,
            'cost' => $this->cost,
            'awards' => json_decode($this->awards, true),
            'applied' => $this->applied($request->user()->id),
            'allow_application_for_limit' => $this->allow_application_for_limit(),
            'applications' => $this->when(request('id') != null, EliminationApplicationResource::collection($this->applications)),
            'levels' => $this->when(request('id') != null, EliminationLevelResource::collection($this->levels)),
        ];
    }
}
