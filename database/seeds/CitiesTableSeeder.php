<?php

use Illuminate\Database\Seeder;
use App\Models\City;
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new City();
        $city->title = 'Adana';
        $city->save();
    }
}
