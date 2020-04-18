<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 12:52
 */

namespace App\Repositories;


use App\Models\Astroturf;
use App\Repositories\Interfaces\IAstroturfRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AstroturfRepository implements IAstroturfRepository
{

    public function findById(int $id): ?Astroturf
    {
        try {
            $astroturf = Astroturf::findOrFail($id);
            return $astroturf;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByCityId(int $id): Collection
    {
        try {
            $astroturfs = Astroturf::where('city_id', $id)->get();
            return $astroturfs;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function findByDistrictId(int $id): Collection
    {
        try {
            $astroturfs = Astroturf::where('district_id', $id)->get();
            return $astroturfs;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $astroturfs = Astroturf::all();
            return $astroturfs;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        try {
            $astroturfs = Astroturf::paginate($count);
            return $astroturfs;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Astroturf
    {
        try {
            $astroturf = new Astroturf();
            $astroturf->facility_id = $data['facility_id'];
            $astroturf->city_id = 1;
            $astroturf->district_id = 1;
            $astroturf->title = $data['title'];
            $astroturf->address = $data['address'];
            $astroturf->price = $data['price'];
            $astroturf->phone = $data['phone'];
            $astroturf->work_hour_start = $data['work_hour_start'];
            $astroturf->work_hour_end = $data['work_hour_end'];
            $astroturf->services = json_encode($data['services']);
            $astroturf->save();
            return $astroturf;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update($id, $data): ?Astroturf
    {
        try {
            $astroturf = $this->findById($id);
            $astroturf->city_id = 1;
            $astroturf->district_id = 1;
            $astroturf->title = $data['title'];
            $astroturf->address = $data['address'];
            $astroturf->price = $data['price'];
            $astroturf->phone = $data['phone'];
            $astroturf->work_hour_start = $data['work_hour_start'];
            $astroturf->work_hour_end = $data['work_hour_end'];
            $astroturf->services = json_encode($data['services']);
            $astroturf->save();
            return $astroturf;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}