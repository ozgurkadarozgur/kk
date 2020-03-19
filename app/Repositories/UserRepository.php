<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 16.03.2020
 * Time: 14:07
 */

namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;

class UserRepository implements IUserRepository
{

    public function findById(int $id): ?User
    {
        try {
            $user = User::findOrFail($id);
            return $user;
        } catch (\Exception $ex){
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?User
    {
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            return $user;
        } catch (\Exception $ex){
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update($id, $data): ?User
    {
        try {
            $user = $this->findById($id);
            if (isset($data['name'])) $user->name = $data['name'];
            if (isset($data['email'])) $user->email = $data['email'];
            if (isset($data['password'])) $user->password = bcrypt($data['password']);
            $user->save();
            return $user;
        } catch (\Exception $ex){
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}