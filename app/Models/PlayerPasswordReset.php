<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PlayerPasswordReset
 * @package App\Models
 * @property $id
 * @property $email
 * @property $token
 */
class PlayerPasswordReset extends Model
{
    public $incrementing = false;

    protected $table = 'player_password_resets';
}
