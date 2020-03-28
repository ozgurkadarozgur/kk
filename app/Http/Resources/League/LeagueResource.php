<?php

namespace App\Http\Resources\League;

use App\Http\Resources\LeagueApplication\LeagueApplicationResource;
use App\Http\Resources\LeagueFixture\LeagueWeekResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LeagueResource extends JsonResource
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
            'is_started' => $this->is_started,
            'type' => 'Lig',
            'facility' => $this->facility_id,
            'title' => $this->title,
            'image_url' => $this->image_url,
            'week_count' => $this->week_count,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'max_team_count' => $this->max_team_count,
            'min_player_count' => $this->min_player_count,
            'cost' => $this->cost,
            'applied' => $this->applied($request->user()->id),
            'allow_application_for_limit' => $this->allow_application_for_limit(),
            'awards' => json_decode($this->awards, true),
            'applications' => $this->when(request('id') != null, LeagueApplicationResource::collection($this->applications)),
        ];
    }
}
