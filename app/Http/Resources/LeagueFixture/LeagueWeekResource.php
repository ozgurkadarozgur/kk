<?php

namespace App\Http\Resources\LeagueFixture;

use Illuminate\Http\Resources\Json\JsonResource;

class LeagueWeekResource extends JsonResource
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
            'id' => $this,
        ];
    }
}
