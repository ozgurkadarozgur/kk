<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 15.03.2020
 * Time: 15:22
 */

namespace App\Repositories\Interfaces;


use App\Models\LeagueApplication;
use Illuminate\Support\Collection;

interface ILeagueApplicationRepository
{
    public function findById(int $id) : ?LeagueApplication;

    public function all() : Collection;

    public function apply(int $league_id, $data) : ?LeagueApplication;
}