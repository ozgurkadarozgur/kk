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
        // TODO: Implement update() method.
    }
}