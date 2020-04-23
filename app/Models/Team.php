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
 * @property $lineup
 * @property $top_players
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

    public function average_power()
    {
        $avg = $this->members()->avg('power');
        return (float)sprintf("%.2f", $avg);
    }

    public function top_players()
    {
        if ($this->top_players != null) {
            $top_players = TeamMember::find(json_decode($this->top_players));
            return $top_players;
        } else {
            return collect([]);
        }
    }

}
