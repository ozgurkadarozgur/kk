<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Team
 * @package App\Models
 * @property $id
 * @property $owner_id
 * @property $title
 * @property $image_url
 * @property $uniform
 * @property $is_active
 */
class Team extends Model
{

    public function owner()
    {
        return $this->belongsTo(Player::class, 'owner_id');
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class, 'team_id');
    }

}
