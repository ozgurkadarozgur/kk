<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class PlayerAstroturfReservation
 * @package App\Models
 * @property $id
 * @property $astroturf_id
 * @property $player_id
 * @property $start_date
 * @property $end_date
 */
class PlayerAstroturfReservation extends Model
{
    protected $table = 'player_astroturf_reservations';
}
