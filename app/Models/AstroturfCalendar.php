<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AstroturfCalendar
 * @package App\Models
 * @property $id
 * @property $astroturf_id
 * @property $title
 * @property $start_date
 * @property $end_date
 * @property $is_subscriber
 */
class AstroturfCalendar extends Model
{
    protected $table = 'astroturf_calendar';

    protected static $day_arr = ['su', 'mo', 'tu', 'we', 'th', 'fr', 'sa'];

    public static function get_day($day)
    {
        return self::$day_arr[$day];
    }

}
