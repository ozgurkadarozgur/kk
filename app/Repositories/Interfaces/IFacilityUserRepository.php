<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 16.03.2020
 * Time: 15:55
 */

namespace App\Repositories\Interfaces;


use App\Models\FacilityUser;
use Illuminate\Support\Collection;

interface IFacilityUserRepository
{
    public function findById(int $id) : ?FacilityUser;

    public function all() : Collection;

    public function create(int $facility_id, $data) : ?FacilityUser;

    public function update(int $id, $data) : ?FacilityUser;

    public function delete(int $id) : ?FacilityUser;
}