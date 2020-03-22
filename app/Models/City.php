<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 * @property $id
 * @property $title
 */
class City extends Model
{
    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class, 'city_id');
    }

    public function __toString()
    {
        return $this->title;
    }

}
