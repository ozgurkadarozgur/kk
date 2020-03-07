<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 14:09
 */

namespace App\Repositories\Interfaces;


use App\Models\AstroturfService;
use Illuminate\Support\Collection;

interface IAstroturfServiceRepository
{
    public function findById(int $id) : ?AstroturfService;

    public function all() : Collection;

    public function create($data) : ?AstroturfService;

    public function update($id, $data) : ?AstroturfService;
}