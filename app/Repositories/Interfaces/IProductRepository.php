<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.04.2020
 * Time: 16:53
 */

namespace App\Repositories\Interfaces;


use App\Models\Product;
use Illuminate\Support\Collection;

interface IProductRepository
{
    public function all() : Collection;

    public function create($data) : ?Product;

    public function findById(int $id) : ?Product;

    public function totalPrice(array $ids) : ?float;

    public function totalPriceForShopping(array $products) : ?float;
}