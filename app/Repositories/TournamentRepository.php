<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 11.03.2020
 * Time: 12:45
 */

namespace App\Repositories;


use App\Repositories\Interfaces\ITournamentRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TournamentRepository implements ITournamentRepository
{

    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    public function paginate(int $count): LengthAwarePaginator
    {
        // TODO: Implement paginate() method.
    }
}