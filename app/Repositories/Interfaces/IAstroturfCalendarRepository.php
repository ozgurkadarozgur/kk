<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 11.03.2020
 * Time: 23:43
 */

namespace App\Repositories\Interfaces;


use App\Models\AstroturfCalendar;
use Illuminate\Support\Collection;

interface IAstroturfCalendarRepository
{
    public function findById(int $id) : ?AstroturfCalendar;

    public function all() : Collection;

    public function findBySubscribeSituation(bool $is_subscribed) : Collection;

    public function create($astroturf_id, $data) : ?AstroturfCalendar;

    public function delete($id) :?AstroturfCalendar;
}