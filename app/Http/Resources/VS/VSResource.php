<?php

namespace App\Http\Resources\VS;

use App\Http\Resources\Astroturf\AstroturfResource;
use App\Http\Resources\Team\TeamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VSResource extends JsonResource
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
            'inviter_team' => new TeamResource($this->inviter_team),
            'invited_team' => new TeamResource($this->invited_team),
            'astroturf' => new AstroturfResource($this->astroturf),
            'status' => $this->status,
            'cost' => $this->cost,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
