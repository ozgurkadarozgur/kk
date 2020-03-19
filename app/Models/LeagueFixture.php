<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeagueFixture
 * @package App\Models
 * @property $id
 * @property $league_id
 * @property $week_number
 * @property $team1_id
 * @property $team2_id
 * @property $astroturf_id
 * @property $team1_score
 * @property $team2_score
 * @property $start_date
 * @property $start_time
 */
class LeagueFixture extends Model
{
    protected $table = 'league_fixtures';

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function astroturf()
    {
        return $this->belongsTo(Astroturf::class, 'astroturf_id');
    }

    public function getForeignDataAttribute()
    {
        return [
            'id' => $this->id,
            'team1' => $this->team1->title,
            'team2' => $this->team2->title,
            'team1_score' => $this->team1_score,
            'team2_score' => $this->team2_score,
            'astroturf' => ($this->astroturf) ? $this->astroturf->title : null,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
        ];
    }

}
