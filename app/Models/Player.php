<?php

namespace App\Models;

use App\Http\Requests\Api\VS\VSRequest;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * Class Player
 * @package App\Models
 * @property $id
 * @property $city_id
 * @property $district_id
 * @property $full_name
 * @property $nick_name
 * @property $phone
 * @property $email
 * @property $password
 * @property $image_url
 * @property $transfer_status
 * @property $skills
 */
class Player extends Authenticatable
{
    use HasApiTokens, Notifiable;

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function incoming_vs_requests()
    {
        return $this->hasMany(VSRequest::class, 'invited_team_id');
    }

    public function outgoing_vs_requests()
    {
        return $this->hasMany(VSRequest::class, 'inviter_team_id');
    }

    public function getSkillListAttribute()
    {
        $skills = $this->skills;
        if ($skills){
            $skills = json_decode($skills);
            return PlayerSkill::find($skills);
        } else {
            return array();
        }
    }

}
