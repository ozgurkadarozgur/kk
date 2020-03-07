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

    public function __toString()
    {
        return $this->title;
    }

}
