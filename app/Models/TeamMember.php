<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamMember
 * @package App\Models
 * @property $id
 * @property $team_id
 * @property $position_id
 * @property $full_name
 * @property $power
 */
class TeamMember extends Model
{
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function position()
    {
        return $this->hasOne(PlayerPosition::class, 'id','position_id');
    }

}
