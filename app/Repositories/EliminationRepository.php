<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 10.03.2020
 * Time: 15:27
 */

namespace App\Repositories;


use App\Models\Elimination;
use App\Models\EliminationApplication;
use App\Models\EliminationLevel;
use App\Repositories\Interfaces\IEliminationRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EliminationRepository implements IEliminationRepository
{

    public function findById(int $id): ?Elimination
    {
        try {
            $elimination = Elimination::findOrFail($id);
            return $elimination;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByFacilityId(int $facility_id) : Collection
    {
        try {
            $eliminations = Elimination::where('facility_id', $facility_id)->get();
            return $eliminations;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByCityId($city_id): Collection
    {
        try {
            $eliminations = Elimination::join('facilities', 'facilities.id', '=', 'eliminations.facility_id')
                ->where('facilities.city_id', '=', $city_id)
                ->select('eliminations.*')
                ->get();
            return $eliminations;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByDistrictId($district_id): Collection
    {
        try {
            $eliminations = Elimination::join('facilities', 'facilities.id', '=', 'eliminations.facility_id')
                ->where('facilities.district_id', '=', $district_id)
                ->select('eliminations.*')
                ->get();
            return $eliminations;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $eliminations = Elimination::all();
            return $eliminations;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        try {
            $eliminations = Elimination::paginate($count);
            return $eliminations;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Elimination
    {
        try {
            DB::beginTransaction();
            $elimination = new Elimination();
            $elimination->facility_id = $data['facility_id'];
            $elimination->title = $data['title'];
            $elimination->start_date = $data['start_date'];
            $elimination->max_team_count = $data['max_team_count'];
            $elimination->level_count = $data['level_count'];
            $elimination->min_player_count = $data['min_player_count'];
            $elimination->cost = $data['cost'];
            $elimination->awards = $data['awards'];
            $elimination->save();

            for ($i = 1; $i <= $data['level_count']; $i++) {
                $level = new EliminationLevel();
                $level->elimination_id = $elimination->id;
                $level->title = $i. '. Aşama';
                $level->order = $i;
                $level->save();
            }

            DB::commit();
            return $elimination;
        } catch (\Exception $ex) {
            DB::rollBack();
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update(int $id, $data): ?Elimination
    {
        try {
            $elimination = $this->findById($id);
            $elimination->facility_id = $data['facility_id'];
            $elimination->title = $data['title'];
            $elimination->start_date = $data['start_date'];
            $elimination->min_player_count = $data['min_player_count'];
            $elimination->cost = $data['cost'];
            $elimination->awards = $data['awards'];
            $elimination->save();
            return $elimination;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function delete(int $id): ?Elimination
    {
        try {
            $elimination = $this->findById($id);
            $elimination->delete();
            return $elimination;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

}