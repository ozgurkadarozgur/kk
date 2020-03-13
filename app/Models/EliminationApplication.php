<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EliminationApplication
 * @package App\Models
 * @property $id
 * @property $elimination_id
 * @property $player_id
 * @property $team_id
 */
class EliminationApplication extends Model
{

    protected $table = 'elimination_applications';

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
