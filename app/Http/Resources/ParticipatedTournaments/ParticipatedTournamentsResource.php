<?php

namespace App\Http\Resources\ParticipatedTournaments;

use App\Http\Resources\Elimination\EliminationResource;
use App\Http\Resources\League\LeagueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipatedTournamentsResource extends JsonResource
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
            'eliminations' => EliminationResource::collection($this->eliminations()),
            'leagues' => LeagueResource::collection($this->leagues()),
        ];
    }
}
