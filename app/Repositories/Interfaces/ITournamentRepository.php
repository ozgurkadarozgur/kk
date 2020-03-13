<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 11.03.2020
 * Time: 12:45
 */

namespace App\Repositories\Interfaces;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ITournamentRepository
{
    public function all() : Collection;

    public function paginate(int $count) : LengthAwarePaginator;
}