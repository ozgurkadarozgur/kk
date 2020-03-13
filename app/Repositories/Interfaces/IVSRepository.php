<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 08.03.2020
 * Time: 17:12
 */

namespace App\Repositories\Interfaces;


use App\Models\VS;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IVSRepository
{
    public function findById(int $id) : ?VS;

    public function all() : Collection;

    public function incoming_vs_requests(int $player_id) : Collection;

    public function incoming_vs_requests_paginate(int $player_id, int $count) : LengthAwarePaginator;

    public function outgoing_vs_requests(int $player_id) : Collection;

    public function outgoing_vs_requests_paginate(int $player_id, int $count) : LengthAwarePaginator;

    public function create($data) : ?VS;

    public function update_status(int $vs_id, $team, $status_code) : ?VS;
}