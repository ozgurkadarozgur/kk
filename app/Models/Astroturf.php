<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Astroturf
 * @package App\Models
 * @property $id
 * @property $facility_id
 * @property $city_id
 * @property $district_id
 * @property $title
 * @property $phone
 * @property $address
 * @property $price
 * @property $work_hour_start
 * @property $work_hour_end
 * @property $services
 */
class Astroturf extends Model
{

    protected $table = 'astroturfs';

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function getServiceListAttribute()
    {
        $services = $this->services;
        if ($services){
            $services = json_decode($services);
            return AstroturfService::find($services);
        } else {
            return array();
        }
    }

    public function calendar()
    {
        return $this->hasMany(AstroturfCalendar::class, 'astroturf_id');
    }

    public function all_reservations($date)
    {
        $query = "select player_astroturf_reservations.id, player_astroturf_reservations.start_date, player_astroturf_reservations.end_date from player_astroturf_reservations          
          where date(player_astroturf_reservations.start_date) = '$date' and player_astroturf_reservations.astroturf_id = $this->id";
        return DB::select($query);
    }

}
