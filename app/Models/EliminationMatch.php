<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EliminationMatch
 * @package App\Models
 * @property $id
 * @property $elimination_id
 * @property $level_id
 * @property $team1_id
 * @property $team2_id
 * @property $team1_score
 * @property $team2_score
 * @property $astroturf_id
 * @property $start_date
 * @property $start_time
 */
class EliminationMatch extends Model
{
    protected $table = 'elimination_matches';

    public function level()
    {
        return $this->belongsTo(EliminationLevel::class, 'level_id');
    }

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

}
