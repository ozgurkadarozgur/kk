<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class District
 * @package App\Models
 * @property $id
 * @property $city_id
 * @property $title
 */
class District extends Model
{
    public $timestamps = false;

    public function __toString()
    {
        return $this->title;
    }

}
