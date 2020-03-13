<?php

use Illuminate\Database\Seeder;
use App\Models\VSStatus;

class VSStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new VSStatus();
        $status->title = 'Onay bekliyor.';
        $status->code = 1;
        $status->text = ':team onay bekliyor.';
        $status->save();

        $status = new VSStatus();
        $status->title = 'Davet edilen takım kabul etti.';
        $status->code = 2;
        $status->text = ':team kabul etti.';
        $status->save();

        $status = new VSStatus();
        $status->title = 'Davet edilen takım reddetti.';
        $status->code = 3;
        $status->text = ':team reddetti.';
        $status->save();

        $status = new VSStatus();
        $status->title = 'Davet eden takım kabul etti.';
        $status->code = 4;
        $status->text = ':team kabul etti.';
        $status->save();

        $status = new VSStatus();
        $status->title = 'Davet eden takım iptal etti.';
        $status->code = 5;
        $status->text = ':team iptal etti.';
        $status->save();
    }
}
