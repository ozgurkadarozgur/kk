<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 08.03.2020
 * Time: 16:19
 */

namespace App\Repositories\Interfaces;


use Illuminate\Support\Collection;

interface IVSStatusRepository
{
    public function all() : Collection;
}