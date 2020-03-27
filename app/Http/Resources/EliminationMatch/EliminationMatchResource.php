<?php

namespace App\Http\Resources\EliminationMatch;

use Illuminate\Http\Resources\Json\JsonResource;

class EliminationMatchResource extends JsonResource
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
            'team1' => [
                'id' => $this->team1->id,
                'title' => $this->team1->title,
                'score' => $this->team1_score,
            ],
            'team2' => [
                'id' => $this->team2->id,
                'title' => $this->team2->title,
                'score' => $this->team2_score,
            ],
            'astroturf' => $this->when($this->astroturf_id != null, [
                'id' => $this->astroturf->id,
                'title' => $this->astroturf->title,
            ]),
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
        ];
    }
}
