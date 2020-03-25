<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VSReservation
 * @package App\Models
 * @property $id
 * @property $inviter_team_id
 * @property $invited_team_id
 * @property $astroturf_id
 * @property $start_date
 * @property $end_date
 */
class VSReservation extends Model
{
    protected $table = 'vs_reservations';

    public function inviter_team()
    {
        return $this->belongsTo(Team::class, 'inviter_team_id');
    }

    public function invited_team()
    {
        return $this->belongsTo(Team::class, 'invited_team_id');
    }

    public function astroturf()
    {
        return $this->belongsTo(Astroturf::class, 'astroturf_id');
    }

}
