<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.04.2020
 * Time: 20:29
 */

namespace App\Repositories\Interfaces;


use App\Models\Order;
use Illuminate\Support\Collection;

interface IOrderRepository
{
    public function findById(int $id) : ?Order;

    public function all() : Collection;

    public function create(array $data) : ?Order;
}