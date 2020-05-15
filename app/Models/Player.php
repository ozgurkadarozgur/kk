<?php

namespace App\Models;

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
 * @property $phone_code
 * @property $phone_confirmed
 * @property $email
 * @property $password
 * @property $image_url
 * @property $transfer_status
 * @property $skills
 * @property $positions
 */
class Player extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
      'city_id', 'district_id', 'nick_name',
    ];

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
        return $this->hasMany(VS::class, 'invited_team_id');
    }

    public function outgoing_vs_requests()
    {
        return $this->hasMany(VS::class, 'inviter_team_id');
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

    public function getPositionListAttribute()
    {
        $positions = $this->positions;
        if ($positions){
            $positions = json_decode($positions);
            return $positions;
        } else {
            return array();
        }
    }

    public function eliminations()
    {
        $ids = $this->hasMany(EliminationApplication::class, 'player_id')
            ->join('eliminations', 'eliminations.id', '=', 'elimination_applications.elimination_id')
            ->select('eliminations.id')
            ->pluck('id');

        return Elimination::find($ids);
    }

    public function leagues()
    {
        $ids = $this->hasMany(LeagueApplication::class, 'player_id')
            ->join('leagues', 'leagues.id', '=', 'league_applications.league_id')
            ->select('leagues.id')
            ->pluck('id');

        return League::find($ids);
    }

    public function hasInvitedTeamForVs($teamId)
    {
        $outgoing_requests = $this->outgoing_vs_requests()->pluck('invited_team_id')->toArray();

        if (in_array($teamId, $outgoing_requests )) return true;
        else return false;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

}
