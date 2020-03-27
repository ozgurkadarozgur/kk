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
        for ($i = 1; $i <= 16; $i++) {
            $player = new Player();
            $player->city_id = 1;
            $player->district_id = 1;
            $player->full_name = 'Player1';
            $player->nick_name = 'Player1_nick_name';
            $player->phone = '5554443320';
            $player->email = 'player1@gmail.com';
            $player->password = '12345678';
            $player->transfer_status = true;
            $player->skills = [1,2];
            $player->phone_code = 123456;
            $player->phone_confirmed = true;
            $player->save();
        }
    }
}
