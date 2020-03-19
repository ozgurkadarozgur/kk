<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 15.03.2020
 * Time: 17:24
 */

namespace App\Repositories\Interfaces;


use App\Models\LeagueFixture;
use Illuminate\Support\Collection;

interface ILeagueFixtureRepository
{
    public function findById(int $id) : ?LeagueFixture;

    public function all() : Collection;

    public function create(int $league_id, $data) : ?LeagueFixture;

    public function update(int $id, $data) : ?LeagueFixture;

    public function update_partial(int $id, $data) : ?LeagueFixture;
}