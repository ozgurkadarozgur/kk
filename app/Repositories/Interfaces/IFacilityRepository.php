<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 06.03.2020
 * Time: 20:15
 */

namespace App\Repositories\Interfaces;


use App\Models\Facility;
use Illuminate\Support\Collection;

interface IFacilityRepository
{
    public function findById(int $id) : ?Facility;

    public function all() : Collection;

    public function create($data) : ?Facility;

    public function update($id, $data) : ?Facility;
}