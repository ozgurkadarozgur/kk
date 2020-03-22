<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 22.03.2020
 * Time: 22:29
 */

namespace App\Repositories;


use App\Models\City;
use App\Repositories\Interfaces\ICityRepository;
use Illuminate\Support\Collection;

class CityRepository implements ICityRepository
{

    public function findById(int $id): City
    {
        try {
            $city = City::findOrFail($id);
            return $city;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $cities = City::all();
            return $cities;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}