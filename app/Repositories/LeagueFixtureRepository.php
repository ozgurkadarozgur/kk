<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 15.03.2020
 * Time: 17:24
 */

namespace App\Repositories;


use App\Models\LeagueFixture;
use App\Repositories\Interfaces\ILeagueFixtureRepository;
use Illuminate\Support\Collection;

class LeagueFixtureRepository implements ILeagueFixtureRepository
{

    public function findById(int $id): ?LeagueFixture
    {
        try {
            $fixture = LeagueFixture::findOrFail($id);
            return $fixture;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $fixtures = LeagueFixture::all();
            return $fixtures;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create(int $league_id, $data): ?LeagueFixture
    {
        try {
            $fixture = new LeagueFixture();
            $fixture->league_id = $league_id;
            $fixture->week_number = $data['week_number'];
            $fixture->team1_id = $data['team1_id'];
            $fixture->team2_id = $data['team2_id'];
            $fixture->save();
            return $fixture;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update(int $id, $data): ?LeagueFixture
    {
        try {

        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
    public function update_partial(int $id, $data): ?LeagueFixture
    {
        try {
            $match = $this->findById($id);
            if (isset($data['team1_id'])) $match->team1_id = $data['team1_id'];
            if (isset($data['team2_id'])) $match->team2_id = $data['team2_id'];
            if (isset($data['team1_score'])) $match->team1_score = $data['team1_score'];
            if (isset($data['team2_score'])) $match->team2_score = $data['team2_score'];
            if (isset($data['astroturf_id'])) $match->astroturf_id = $data['astroturf_id'];
            if (isset($data['start_date'])) $match->start_date = $data['start_date'];
            if (isset($data['start_time'])) $match->start_time = $data['start_time'];
            $match->save();
            return $match;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

}