<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Elimination
 * @package App\Models
 * @property $id
 * @property $facility_id
 * @property $title
 * @property $image_url
 * @property $start_date
 * @property $end_date
 * @property $max_team_count
 * @property $level_count
 * @property $min_player_count
 * @property $cost
 * @property $awards
 * @property $is_started
 * @property $is_open
 */
class Elimination extends Model
{
    protected $table = 'eliminations';

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function applications()
    {
        return $this->hasMany(EliminationApplication::class, 'elimination_id');
    }

    public function levels()
    {
        return $this->hasMany(EliminationLevel::class, 'elimination_id')->orderBy('order', 'asc');
    }

}
