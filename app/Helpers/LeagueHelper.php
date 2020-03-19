<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 19.03.2020
 * Time: 12:26
 */

namespace App\Helpers;


use App\Models\League;
use App\Repositories\Interfaces\ILeagueFixtureRepository;

class LeagueHelper
{

    private $leagueFixtureRepository;

    public function __construct(ILeagueFixtureRepository $leagueFixtureRepository)
    {
        $this->leagueFixtureRepository = $leagueFixtureRepository;
    }

    public function create_fixture(League $tournament)
    {

        $teamSize = count($tournament->applications);

        // Kaç round sonrası lig tamamlanacak
        $roundCount = $teamSize-1;
        // Bir round'da ne kadar maç oynanır
        $matchCountPerRound=$teamSize/2;

        $list=[];

        // Takim listesini oluşturuyoruz.
        //0. takımdan (teamSize-1). takima kadar.

        foreach ($tournament->applications as $item){
            array_push($list, $item);
        }

        for ($i = 0; $i < $roundCount; $i++) {

            for($j=0; $j < $matchCountPerRound; $j++){

                $firstIndex=$j;
                $secondIndex=($teamSize-1)-$j;
                $week = $i + 1;
                $firstTeam = $list[$firstIndex];
                $secondTeam = $list[$secondIndex];

                $fixture_data = [
                    'week_number' => $week,
                    'team1_id' => $firstTeam->team_id,
                    'team2_id' => $secondTeam->team_id,
                ];

                $this->leagueFixtureRepository->create($tournament->id, $fixture_data);
            }

            // İlk eleman sabit olacak şekilde elamanları kaydırıyoruz
            $newList=[];

            // İlk eleman sabit
            array_push($newList, $list[0]);

            // Son eleman ikinci eleman yapıyoruz.
            array_push($newList, $list[count($list) - 1]);
            //newList.add(list.get(list.size()-1));

            for($k=1; $k<count($list)-1;$k++){
                array_push($newList, $list[$k]);
            }

            // Keydırılan liste yeni liste oluyor.
            $list = $newList;
        }
    }
}