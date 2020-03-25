<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 25.03.2020
 * Time: 23:11
 */

namespace App\Repositories;


use App\Models\PlayerAstroturfReservation;
use App\Repositories\Interfaces\IPlayerAstroturfReservationRepository;

class PlayerAstroturfReservationRepository implements IPlayerAstroturfReservationRepository
{

    public function findById(int $id): ?PlayerAstroturfReservation
    {
        try {
            $reservation = PlayerAstroturfReservation::findOrFail($id);
            return $reservation;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?PlayerAstroturfReservation
    {
        try {
            $reservation = new PlayerAstroturfReservation();
            $reservation->player_id = $data['player_id'];
            $reservation->astroturf_id = $data['astroturf_id'];
            $reservation->start_date = $data['start_date'];
            $reservation->end_date = $data['end_date'];
            $reservation->save();
            return $reservation;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}