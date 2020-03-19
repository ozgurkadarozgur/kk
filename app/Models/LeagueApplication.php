<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LeagueApplication
 * @package App\Models
 * @property $id
 * @property $league_id
 * @property $player_id
 * @property $team_id
 */
class LeagueApplication extends Model
{
    protected $table = 'league_applications';

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

}
