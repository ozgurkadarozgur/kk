<?php

use Illuminate\Database\Seeder;
use App\Models\LeagueApplication;

class LeagueApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i < 12; $i++) {
            $team = \App\Models\Team::find($i);
            $application = new LeagueApplication();
            $application->league_id = 1;
            $application->team_id = $i;
            $application->player_id = $team->owner_id;
            $application->save();
        }
    }
}
