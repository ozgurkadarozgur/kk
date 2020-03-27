<?php

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 10; $i < 17; $i++) {
            $player = new Player();
            $player->city_id = 1;
            $player->district_id = 1;
            $player->full_name = 'Player'.$i;
            $player->nick_name = 'Player'.$i.'_nick_name';
            $player->phone = '55544433'.$i;
            $player->email = 'player'.$i.'@gmail.com';
            $player->password = bcrypt('12345678');
            $player->transfer_status = true;
            $player->skills = json_encode([1,2]);
            $player->phone_code = 123456;
            $player->phone_confirmed = true;
            $player->save();
        }
    }
}
