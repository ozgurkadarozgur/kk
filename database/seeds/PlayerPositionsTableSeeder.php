<?php

use Illuminate\Database\Seeder;
use App\Models\PlayerPosition;

class PlayerPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position = new PlayerPosition();
        $position->title = 'Forvet';
        $position->save();

        $position = new PlayerPosition();
        $position->title = 'Orta Saha';
        $position->save();

        $position = new PlayerPosition();
        $position->title = 'Defans';
        $position->save();
    }
}
