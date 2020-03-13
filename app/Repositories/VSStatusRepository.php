<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 08.03.2020
 * Time: 16:19
 */

namespace App\Repositories;


use App\Models\VSStatus;
use App\Repositories\Interfaces\IVSStatusRepository;
use Illuminate\Support\Collection;

class VSStatusRepository implements IVSStatusRepository
{

    public function all(): Collection
    {
        try {
            $statuses = VSStatus::all();
            return $statuses;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}