<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 15.03.2020
 * Time: 01:11
 */

namespace App\Repositories\Interfaces;


use App\Models\League;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ILeagueRepository
{
    public function findById(int $id) : ?League;

    public function findByDistrictId($district_id) : Collection;

    public function all() : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?League;

    public function update($id, $data) : ?League;

    public function delete($id) : ?League;
}