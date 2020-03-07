<?php

use Illuminate\Database\Seeder;
use App\Models\District;
class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $district = new District();
        $district->city_id = 1;
        $district->title = 'Seyhan';
        $district->save();
    }
}
