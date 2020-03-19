<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 16.03.2020
 * Time: 14:08
 */

namespace App\Repositories\Interfaces;


use App\Models\User;

interface IUserRepository
{
    public function findById(int $id) : ?User;

    public function create($data) : ?User;

    public function update($id, $data) : ?User;
}