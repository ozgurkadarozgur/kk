<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 10.03.2020
 * Time: 15:27
 */

namespace App\Repositories\Interfaces;


use App\Models\Elimination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IEliminationRepository
{
    public function findById(int $id) : ?Elimination;

    public function findByFacilityId(int $facility_id) : Collection;

    public function all() : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?Elimination;

    public function update(int $id, $data) : ?Elimination;

    public function delete(int $id) : ?Elimination;
}