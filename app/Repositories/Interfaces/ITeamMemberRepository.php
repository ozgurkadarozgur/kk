<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 21:11
 */

namespace App\Repositories\Interfaces;


use App\Models\TeamMember;
use Illuminate\Support\Collection;

interface ITeamMemberRepository
{
    public function findById(int $id) : ?TeamMember;

    public function all() : Collection;

    public function create($data) : ?TeamMember;
}