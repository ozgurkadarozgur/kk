<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 15.03.2020
 * Time: 01:10
 */

namespace App\Repositories;


use App\Models\League;
use App\Repositories\Interfaces\ILeagueRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LeagueRepository implements ILeagueRepository
{

    public function findById(int $id): ?League
    {
        try {
            $league = League::findOrFail($id);
            return $league;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByCityId($city_id): Collection
    {
        try {
            $leagues = League::join('facilities', 'facilities.id', '=', 'leagues.facility_id')
                ->where('facilities.city_id', '=', $city_id)
                ->select('leagues.*')
                ->get();
            return $leagues;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByDistrictId($district_id): Collection
    {
        try {
            $leagues = League::join('facilities', 'facilities.id', '=', 'leagues.facility_id')
                ->where('facilities.district_id', '=', $district_id)
                ->select('leagues.*')
                ->get();
            return $leagues;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function standings(int $id): Collection
    {
        try {
            $query = "select * from league_standings(?);";
            $standings = DB::select($query, [$id]);
            return collect($standings);
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $leagues = League::all();
            return $leagues;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        try {
            $leagues = League::paginate($count);
            return $leagues;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?League
    {
        try {
            $league = new League();
            $league->facility_id = $data['facility_id'];
            $league->title = $data['title'];
            $league->start_date = $data['start_date'];
            $league->week_count = $data['week_count'];
            $league->max_team_count = $data['max_team_count'];
            $league->min_player_count = $data['min_player_count'];
            $league->cost = $data['cost'];
            $league->awards = $data['awards'];
            $league->save();
            return $league;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update($id, $data): ?League
    {
        try {
            $league = $this->findById($id);
            $league->title = $data['title'];
            $league->start_date = $data['start_date'];
            $league->week_count = $data['week_count'];
            $league->max_team_count = $data['max_team_count'];
            $league->min_player_count = $data['min_player_count'];
            $league->cost = $data['cost'];
            $league->awards = $data['awards'];
            $league->save();
            return $league;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function delete($id): ?League
    {
        try {
            $league = $this->findById($id);
            $league->delete();
            return $league;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}