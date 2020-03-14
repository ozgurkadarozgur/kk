<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 14.03.2020
 * Time: 15:27
 */

namespace App\Repositories;


use App\Models\EliminationLevel;
use App\Repositories\Interfaces\IEliminationLevelRepository;
use Illuminate\Support\Collection;

class EliminationLevelRepository implements IEliminationLevelRepository
{

    public function findById(int $id): ?EliminationLevel
    {
        try {
            $level = EliminationLevel::findOrFail($id);
            return $level;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByEliminationId(int $elimination_id): Collection
    {
        try {
            $levels = EliminationLevel::where('elimination_id', $elimination_id)->get();
            return $levels;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $levels = EliminationLevel::all();
            return $levels;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}