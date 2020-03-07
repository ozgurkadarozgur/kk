<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 20:07
 */

namespace App\Repositories\Interfaces;


use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ITeamRepository
{
    public function findById(int $id) : ?Team;

    public function all() : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?Team;
}