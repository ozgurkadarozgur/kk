<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VS
 * @package App\Models
 * @property $id
 * @property $inviter_id
 * @property $inviter_team_id
 * @property $invited_id
 * @property $invited_team_id
 * @property $astroturf_id
 * @property $status_code
 * @property $cost
 * @property $start_date
 * @property $end_date
 *
 */
class VS extends Model
{
    protected $table = 'vs';

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

    public function status()
    {
        return $this->hasOne(VSStatus::class, 'code','status_code');
    }

    public function logs()
    {
        return $this->hasMany(VSStatusLog::class, 'vs_id');
    }

}
