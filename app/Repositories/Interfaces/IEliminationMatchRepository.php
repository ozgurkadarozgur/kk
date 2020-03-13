<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 13.03.2020
 * Time: 18:33
 */

namespace App\Repositories\Interfaces;


use App\Models\EliminationMatch;
use Illuminate\Support\Collection;

interface IEliminationMatchRepository
{
    public function findById(int $id) : ?EliminationMatch;

    public function all() : Collection;

    public function create(int $elimination_id, int $level_id, $data) : ?EliminationMatch;

    public function update(int $id, $data) : ?EliminationMatch;

    public function delete(int $id) : ?EliminationMatch;
}