<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 23.03.2020
 * Time: 00:12
 */

namespace App\Repositories\Interfaces;


use App\Models\PlayerPosition;
use Illuminate\Support\Collection;

interface IPlayerPositionRepository
{
    public function findById(int $id) : ?PlayerPosition;

    public function all() : Collection;
}