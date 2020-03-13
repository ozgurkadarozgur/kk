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
 * @property $city_id
 * @property $district_id
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

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

}
