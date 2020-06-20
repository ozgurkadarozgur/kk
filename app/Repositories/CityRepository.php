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

    public function customOrder() : Collection
    {
        try {

                //40 istanbul
                //7 ankara
                //41 izmir
                //1 adana

                $istanbul = City::find(40);
                $ankara = City::find(7);
                $izmir = City::find(41);
                $adana = City::find(1);
                $cities = City::whereNotIn('id', [1,7,40,41])->get();
                $cities = collect($cities);
                $cities->prepend($adana);
                $cities->prepend($izmir);
                $cities->prepend($ankara);
                $cities->prepend($istanbul);
                return $cities;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

}