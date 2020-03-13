<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 13.03.2020
 * Time: 18:33
 */

namespace App\Repositories;


use App\Models\EliminationMatch;
use App\Repositories\Interfaces\IEliminationMatchRepository;
use Illuminate\Support\Collection;

class EliminationMatchRepository implements IEliminationMatchRepository
{

    public function findById(int $id): ?EliminationMatch
    {
        try {
            $match = EliminationMatch::findOrFail($id);
            return $match;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $matches = EliminationMatch::all();
            return $matches;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create(int $elimination_id, int $level_id, $data): ?EliminationMatch
    {
        try {
            $match = new EliminationMatch();
            $match->elimination_id = $elimination_id;
            $match->level_id = $level_id;
            $match->team1_id = $data['team1_id'];
            $match->team2_id = $data['team2_id'];
            $match->save();
            return $match;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update(int $id, $data): ?EliminationMatch
    {
        try {
            $match = new EliminationMatch();
            $match->team1_id = $data['team1_id'];
            $match->team2_id = $data['team2_id'];
            $match->team1_score = $data['team1_score'];
            $match->team2_score = $data['team2_score'];
            $match->astroturf_id = $data['astroturf_id'];
            $match->start_date = $data['start_date'];
            $match->start_time = $data['start_time'];
            $match->save();
            return $match;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function delete(int $id): ?EliminationMatch
    {
        try {
            $match = $this->findById($id);
            $match->delete();
            return $match;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}