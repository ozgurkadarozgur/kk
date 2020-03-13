<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 11.03.2020
 * Time: 13:21
 */

namespace App\Repositories\Interfaces;


use App\Models\EliminationApplication;
use Illuminate\Support\Collection;

interface IEliminationApplicationRepository
{
    public function findById(int $id) : ?EliminationApplication;

    public function all() : Collection;

    public function apply(int $elimination_id, $data) : ?EliminationApplication;
}