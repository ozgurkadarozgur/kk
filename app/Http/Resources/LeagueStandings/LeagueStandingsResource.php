<?php

namespace App\Http\Resources\LeagueStandings;

use Illuminate\Http\Resources\Json\JsonResource;

class LeagueStandingsResource extends JsonResource
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
            'number' => $this->number,
            'team' => $this->team,
            'played' => $this->played,
            'wins' => $this->wins,
            'draws' => $this->draws,
            'losses' => $this->losses,
            'total_score' => $this->total_score,
            'total_against_score' => $this->total_against_score,
            'total_difference' => $this->total_difference,
            'total_point' => $this->total_point,
        ];
    }
}
