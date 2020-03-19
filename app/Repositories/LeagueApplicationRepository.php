<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 15.03.2020
 * Time: 15:22
 */

namespace App\Repositories;


use App\Models\LeagueApplication;
use App\Repositories\Interfaces\ILeagueApplicationRepository;
use Illuminate\Support\Collection;

class LeagueApplicationRepository implements ILeagueApplicationRepository
{

    public function findById(int $id): ?LeagueApplication
    {
        try {
            $application = LeagueApplication::findOrFail($id);
            return $application;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $applications = LeagueApplication::all();
            return $applications;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function apply(int $league_id, $data): ?LeagueApplication
    {
        try {
            $application = new LeagueApplication();
            $application->league_id = $league_id;
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