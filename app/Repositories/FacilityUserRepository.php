<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 16.03.2020
 * Time: 15:55
 */

namespace App\Repositories;


use App\Models\FacilityUser;
use App\Repositories\Interfaces\IFacilityUserRepository;
use Illuminate\Support\Collection;

class FacilityUserRepository implements IFacilityUserRepository
{
    public function findById(int $id): ?FacilityUser
    {
        try {
            $user = FacilityUser::findOrFail($id);
            return $user;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $users = FacilityUser::all();
            return $users;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create(int $facility_id, $data): ?FacilityUser
    {
        try {
            $user = new FacilityUser();
            $user->facility_id = $facility_id;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            return $user;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update(int $id, $data): ?FacilityUser
    {
        try {
            $user = $this->findById($id);
            if (isset($data['name'])) $user->name = $data['name'];
            if (isset($data['email'])) $user->email = $data['email'];
            if (isset($data['password'])) $user->password = bcrypt($data['password']);
            $user->save();
            return $user;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function delete(int $id): ?FacilityUser
    {
        try {
            $user = $this->findById($id);
            $user->delete();
            return $user;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}