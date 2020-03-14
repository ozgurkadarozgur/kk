<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 14.03.2020
 * Time: 15:26
 */

namespace App\Repositories\Interfaces;


use App\Models\EliminationLevel;
use Illuminate\Support\Collection;

interface IEliminationLevelRepository
{
    public function findById(int $id) : ?EliminationLevel;

    public function findByEliminationId(int $elimination_id) : Collection;

    public function all() : Collection;
}