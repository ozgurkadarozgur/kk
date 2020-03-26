<?php

namespace App\Http\Resources\Astroturf;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AllReservationsResource extends JsonResource
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
            'title' => 'dolu',
            'start' => $this->start_date,
            'start_time' => Carbon::parse($this->start_date)->format('H:i'),
            'end' => $this->end_date,
            'end_time' => Carbon::parse($this->end_date)->format('H:i'),
            'reservation' => true,
        ];
    }
}
