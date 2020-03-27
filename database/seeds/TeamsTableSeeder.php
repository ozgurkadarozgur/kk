<?php

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 12; $i <= 27; $i++) {
            $team = new Team();
            $team->owner_id = $i;
            $team->city_id = 1;
            $team->district_id = 1;
            $team->title = 'Player.' . $i . '_Spor';
            $team->uniform = 1;
            $team->save();
        }
    }
}
