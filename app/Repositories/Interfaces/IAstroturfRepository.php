<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 12:52
 */

namespace App\Repositories\Interfaces;


use App\Models\Astroturf;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IAstroturfRepository
{
    public function findById(int $id) : ?Astroturf;

    public function all() : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?Astroturf;

    public function update($id, $data) : ?Astroturf;
}