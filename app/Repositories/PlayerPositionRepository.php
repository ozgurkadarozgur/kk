<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 23.03.2020
 * Time: 00:12
 */

namespace App\Repositories;


use App\Models\PlayerPosition;
use App\Repositories\Interfaces\IPlayerPositionRepository;
use Illuminate\Support\Collection;

class PlayerPositionRepository implements IPlayerPositionRepository
{

    public function findById(int $id): ?PlayerPosition
    {
        try {
            $position = PlayerPosition::findOrFail($id);
            return $position;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $positions = PlayerPosition::all();
            return $positions;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}