<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Facility
 * @package App\Models
 * @property $id
 * @property $title
 * @property $owner
 * @property $phone
 * @property $email
 * @property $bank_account
 * @property $city_id
 * @property $district_id
 * @property $is_active
 */
class Facility extends Model
{
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function astroturfs()
    {
        return $this->hasMany(Astroturf::class, 'facility_id');
    }

    public function users()
    {
        return $this->hasMany(FacilityUser::class, 'facility_id');
    }

}
