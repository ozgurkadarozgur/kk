<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class FacilityUser
 * @package App\Models
 * @property $id
 * @property $facility_id
 * @property $name
 * @property $email
 * @property $password
 */
class FacilityUser extends Authenticatable
{
    protected $table = 'facility_users';

    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id');
    }

}
