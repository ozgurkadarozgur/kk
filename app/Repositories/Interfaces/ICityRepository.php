<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 22.03.2020
 * Time: 22:29
 */

namespace App\Repositories\Interfaces;


use App\Models\City;
use Illuminate\Support\Collection;

interface ICityRepository
{
    public function findById(int $id) : City;

    public function all() : Collection;

    public function customOrder() : Collection;
}