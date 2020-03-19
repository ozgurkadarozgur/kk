<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 15:11
 */

namespace App\Repositories;


use App\Models\Player;
use App\Repositories\Interfaces\IPlayerRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PlayerRepository implements IPlayerRepository
{

    public function findById(int $id): ?Player
    {
        try {
            $player = Player::findOrFail($id);
            return $player;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all($limit = null): Collection
    {
        try {
            $players = null;
            if ($limit) {
                $players = Player::all()->take($limit);
            } else {
                $players = Player::all();
            }
            return $players;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        try {
            $players = Player::paginate($count);
            return $players;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Player
    {
        try {
            $player = new Player();
            $player->full_name = $data['full_name'];
            $player->nick_name = $data['nick_name'];
            $player->phone = $data['phone'];
            $player->email = $data['email'];
            $player->password = bcrypt($data['password']);
            //$player->image_url = $data['image_url'];
            $player->city_id = $data['city_id'];
            $player->district_id = $data['district_id'];
            $player->skills = $data['skills'];
            $player->transfer_status = $data['transfer_status'];
            $player->save();
            return $player;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

}