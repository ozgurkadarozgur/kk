<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 06.03.2020
 * Time: 20:15
 */

namespace App\Repositories;


use App\Models\Facility;
use App\Repositories\Interfaces\IFacilityRepository;
use Illuminate\Support\Collection;

class FacilityRepository implements IFacilityRepository
{

    public function findById(int $id): ?Facility
    {
        try {
            $facility = Facility::findOrFail($id);
            return $facility;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all($limit = null): Collection
    {
        try {
            $facilities = null;
            if ($limit) {
                $facilities = Facility::all()->take($limit);
            } else {
                $facilities = Facility::all();
            }
            return $facilities;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?Facility
    {
        try {
            $facility = new Facility();
            $facility->title = $data['title'];
            $facility->owner = $data['owner'];
            $facility->phone = $data['phone'];
            $facility->email = $data['email'];
            $facility->city_id = 1;
            $facility->district_id = 1;
            $facility->bank_account = $data['bank_account'];
            $facility->save();
            return $facility;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update($id, $data): ?Facility
    {
        // TODO: Implement update() method.
    }
}