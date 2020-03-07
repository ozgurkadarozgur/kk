<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 17:38
 */

namespace App\Repositories\Interfaces;


use App\Models\PlayerSkill;
use Illuminate\Support\Collection;

interface IPlayerSkillRepository
{
    public function findById(int $id) : ?PlayerSkill;

    public function all() : Collection;

    public function create($data) : ?PlayerSkill;
}