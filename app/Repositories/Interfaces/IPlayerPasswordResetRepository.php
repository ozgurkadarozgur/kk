<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 23.03.2020
 * Time: 21:13
 */

namespace App\Repositories\Interfaces;


use App\Models\PlayerPasswordReset;

interface IPlayerPasswordResetRepository
{
    public function findByEmail(string $email) : ?PlayerPasswordReset;

    public function findByToken(string $token) : ?PlayerPasswordReset;

    public function createResetPasswordToken(string $email, string $token) : bool ;
}