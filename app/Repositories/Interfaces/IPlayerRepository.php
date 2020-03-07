<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 15:20
 */

namespace App\Repositories\Interfaces;


use App\Models\Player;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IPlayerRepository
{
    public function findById(int $id) : ?Player;

    public function all() : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?Player;
}