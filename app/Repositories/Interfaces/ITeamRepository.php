<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 20:07
 */

namespace App\Repositories\Interfaces;


use App\Models\Player;
use App\Models\Team;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ITeamRepository
{
    public function findById(int $id) : ?Team;

    public function findByIdList(array $id_list) : Collection;

    public function findTeamsForVs(Player $player) : Collection;

    public function setLineup(int $id, $data) : ?Team;

    public function setTopPlayers(int $id, $data) : ?Team;

    public function all($limit) : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?Team;

    public function destroy(int $id) : ?Team;
}