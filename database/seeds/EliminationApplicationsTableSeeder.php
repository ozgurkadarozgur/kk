<?php

use Illuminate\Database\Seeder;
use App\Models\EliminationApplication;

class EliminationApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i < 9; $i++) {
            $team = \App\Models\Team::find($i);
            $application = new EliminationApplication();
            $application->elimination_id = 3;
            $application->team_id = $i;
            $application->player_id = $team->owner_id;
            $application->save();
        }
    }
}
