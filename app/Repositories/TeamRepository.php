<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 20:07
 */

namespace App\Repositories;


use App\Models\Team;
use App\Repositories\Interfaces\ITeamRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TeamRepository implements ITeamRepository
{

    public function findById(int $id): ?Team
    {
        try {
            $team = Team::findOrFail($id);
            return $team;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByIdList(array $id_list): Collection
    {
        try {
            $teams = Team::find($id_list);
            return $teams;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all($limit = null): Collection
    {
        try {
            $teams = null;
            if ($limit) {
                $teams = Team::all()->take($limit);
            } else {
                $teams = Team::all();
            }
            return $teams;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        try {
            $teams = Team::paginate($count);
            return $teams;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Team
    {
        try {
            $team = new Team();
            $team->owner_id = $data['owner_id'];
            $team->title = $data['title'];
            $team->uniform = $data['uniform'];
            $team->city_id = $data['city_id'];
            $team->district_id = $data['district_id'];
            //$team->image_url = $data['image_url'];
            $team->save();
            return $team;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function destroy(int $id): ?Team
    {
        try {
            $team = $this->findById($id);
            $team->delete();
            return $team;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}