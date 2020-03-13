<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 11.03.2020
 * Time: 13:20
 */

namespace App\Repositories;


use App\Models\EliminationApplication;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use Illuminate\Support\Collection;

class EliminationApplicationRepository implements IEliminationApplicationRepository
{

    public function findById(int $id): ?EliminationApplication
    {
        try {
            $application = EliminationApplication::findOrFail($id);
            return $application;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $applications = EliminationApplication::all();
            return $applications;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function apply(int $elimination_id, $data): ?EliminationApplication
    {
        try {
            $application = new EliminationApplication();
            $application->elimination_id = $elimination_id;
            $application->player_id = $data['player_id'];
            $application->team_id = $data['team_id'];
            $application->save();
            return $application;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}