<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 23.03.2020
 * Time: 21:13
 */

namespace App\Repositories;


use App\Models\PlayerPasswordReset;
use App\Repositories\Interfaces\IPlayerPasswordResetRepository;

class PlayerPasswordResetRepository implements IPlayerPasswordResetRepository
{
    public function createResetPasswordToken(string $email, string $token): bool
    {
        try {
            $reset = new PlayerPasswordReset();
            $reset->email = $email;
            $reset->token = $token;
            $reset->save();
            return true;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return false;
        }
    }

    public function findByEmail(string $email): ?PlayerPasswordReset
    {
        try {
            $password_reset = PlayerPasswordReset::where('email', $email)->first();
            return $password_reset;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByToken(string $token): ?PlayerPasswordReset
    {
        try {
            $password_reset = PlayerPasswordReset::where('token', $token)->first();
            return $password_reset;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}