<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 25.03.2020
 * Time: 22:13
 */

namespace App\Repositories;


use App\Models\VS;
use App\Models\VSReservation;
use App\Repositories\Interfaces\IVSReservationRepository;

class VSReservationRepository implements IVSReservationRepository
{

    public function findById(int $id): ?VSReservation
    {
        try {
            $reservation = VSReservation::findOrFail($id);
            return $reservation;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create(VS $vs): ?VSReservation
    {
        try {
            $reservation = new VSReservation();
            $reservation->inviter_team_id = $vs->inviter_team_id;
            $reservation->invited_team_id = $vs->invited_team_id;
            $reservation->astroturf_id = $vs->astroturf_id;
            $reservation->start_date = $vs->start_date;
            $reservation->end_date = $vs->end_date;
            $reservation->save();
            return $reservation;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}