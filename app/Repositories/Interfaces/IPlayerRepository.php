<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 15:20
 */

namespace App\Repositories\Interfaces;


use App\Models\Player;
use App\Models\PlayerPasswordReset;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IPlayerRepository
{
    public function findById(int $id) : ?Player;

    public function findByEmail(string $email) : ?Player;

    public function all($limit) : Collection;

    public function paginate(int $count) : LengthAwarePaginator;

    public function create($data) : ?Player;

    public function resetPassword(Player $player, string $new_password) : ?Player;
}