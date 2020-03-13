<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VSStatus
 * @package App\Models
 * @property $id
 * @property $title
 * @property $code
 * @property $text
 */
class VSStatus extends Model
{

    protected $table = 'vs_status';

    public $timestamps = false;

    public const WAITING_FOR_APPROVAL = 1;
    public const INVITED_APPROVED = 2;
    public const INVITED_REJECTED = 3;
    public const INVITER_APPROVED = 4;
    public const INVITER_CANCELED = 5;

    private static $messages = [
        self::WAITING_FOR_APPROVAL => ':team Onay Bekliyor.',
        self::INVITED_APPROVED => ':team Onayladı.',
        self::INVITED_REJECTED => ':team Reddetti.',
        self::INVITER_APPROVED=> ':team Onayladı.',
        self::INVITER_CANCELED=> ':team İptal Etti.',
    ];

    public static function get_status_message($status_code, $team)
    {
        return str_replace(':team', $team, self::$messages[$status_code]);
    }

}
