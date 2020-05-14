<?php

namespace App\Http\Resources\LeagueApplication;

use App\Http\Resources\Team\TeamResource;
use App\Http\Resources\TeamMember\TeamMemberResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LeagueApplicationResource extends JsonResource
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
            'team' => new TeamResource($this->team),
        ];
    }
}
