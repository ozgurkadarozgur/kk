<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EliminationLevel
 * @package App\Models
 * @property $id
 * @property $elimination_id
 * @property $title
 */
class EliminationLevel extends Model
{
    protected $table = 'elimination_levels';

    public function matches()
    {
        return $this->hasMany(EliminationMatch::class, 'level_id');
    }

}
