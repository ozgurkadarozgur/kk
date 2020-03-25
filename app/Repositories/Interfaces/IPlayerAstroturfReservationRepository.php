<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 25.03.2020
 * Time: 23:11
 */

namespace App\Repositories\Interfaces;


use App\Models\PlayerAstroturfReservation;

interface IPlayerAstroturfReservationRepository
{
    public function findById(int $id) : ?PlayerAstroturfReservation;

    public function create($data) : ?PlayerAstroturfReservation;
}