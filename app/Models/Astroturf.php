<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
