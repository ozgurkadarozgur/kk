<?php

namespace App\Http\Resources\Team;

use App\Http\Resources\TeamMember\TeamMemberResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'has_invited_for_vs' => $request->user()->hasInvitedTemForVs($this->id),
            'title' => $this->title,
            'lineup' => $this->lineup,
            'top_players' => TeamMemberResource::collection($this->top_players()),
            'image_url' => $this->image_url,
            'uniform' => $this->uniform,
            'city' => $this->city->title,
            'district' => $this->district->title,
            'members' => TeamMemberResource::collection($this->members),
            'average_power' => $this->average_power(),
        ];
    }
}
