<?php

namespace App\Http\Resources\AstroturfCalendar;

use App\Models\AstroturfCalendar;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AstroturfCalendarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = null;
        if ($this->is_subscriber) {
            $data =  [
                'id' => $this->id,
                'title' => $this->title,
                'is_subscriber' => $this->is_subscriber,
                'rrule' => [
                    'freq' => 'weekly',
                    'interval' => 1,
                    'byweekday' => AstroturfCalendar::get_day(Carbon::parse($this->start_date)->WeekDay()),
                    'dtstart' => $this->start_date
                ]
            ];
        } else {
            $data =  [
                'id' => $this->id,
                'title' => $this->title,
                'start' => $this->start_date,
                'end' => $this->end_date,
            ];
        }

        return $data;
    }
}
