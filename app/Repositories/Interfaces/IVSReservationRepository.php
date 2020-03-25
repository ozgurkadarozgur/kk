<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 25.03.2020
 * Time: 22:14
 */

namespace App\Repositories\Interfaces;


use App\Models\VS;
use App\Models\VSReservation;

interface IVSReservationRepository
{
    public function findById(int $id) : ?VSReservation;

    public function create(VS $vs) : ?VSReservation;
}