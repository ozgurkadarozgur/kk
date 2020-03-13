<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VSStatusLog
 * @package App\Models
 * @property $id
 * @property $vs_id
 * @property $status_code
 * @property $text
 */
class VSStatusLog extends Model
{
    protected $table = 'vs_status_logs';
}
