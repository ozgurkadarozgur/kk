<?php

namespace App\Http\Resources\LeagueFixture;

use App\Http\Resources\Team\TeamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LeagueFixtureResource extends JsonResource
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
                'info' => new TeamResource($this->team1),
                'score' => $this->team1_score,
                /*
                'id' => $this->team1->id,
                'title' => $this->team1->title,
                'uniform' => $this->team1->uniform,
                'score' => $this->team1_score,
                */
            ],
            'team2' => [
                'info' => new TeamResource($this->team2),
                'score' => $this->team2_score,
                /*
                'id' => $this->team2->id,
                'title' => $this->team2->title,
                'uniform' => $this->team2->uniform,
                'score' => $this->team2_score,
                */
            ],
            'astroturf' => ($this->astroturf_id != null) ? [
                'id' => $this->astroturf->id,
                'title' => $this->astroturf->title,
            ] : null,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
        ];
    }
}
