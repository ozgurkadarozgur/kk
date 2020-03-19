<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\PayfullHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use App\Repositories\Interfaces\ILeagueApplicationRepository;
use App\Repositories\Interfaces\IVSRepository;

class PayfullController extends Controller
{
    private $leagueApplicationRepository;
    private $eliminationApplicationRepository;
    private $vsRepository;

    public function __construct(ILeagueApplicationRepository $leagueApplicationRepository, IEliminationApplicationRepository $eliminationApplicationRepository, IVSRepository $vsRepository)
    {
        $this->leagueApplicationRepository = $leagueApplicationRepository;
        $this->eliminationApplicationRepository = $eliminationApplicationRepository;
        $this->vsRepository = $vsRepository;
    }

    public function handle_response()
    {
        $data = $_POST;

        if ($data['status'] == 1) {
            if ($data['confirm_action'] == 0) {
                $meta = json_decode($data['passive_data']);
                $process_type = $meta->processType;
                switch ($process_type) {
                    case PayfullHelper::PROCESS_TYPE_LEAGUE_APPLICATION : {
                        $league_id = $meta->league_id;
                        $data = [
                            'player_id' => $meta->player_id,
                            'team_id' => $meta->team_id,
                        ];
                        $this->leagueApplicationRepository->apply($league_id, $data);
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_ELIMINATION_APPLICATION : {
                        $elimination_id = $meta->league_id;
                        $data = [
                            'player_id' => $meta->player_id,
                            'team_id' => $meta->team_id,
                        ];
                        $this->eliminationApplicationRepository->apply($elimination_id, $data);
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_VS_INVITED_ACCEPT : {
                        $vs_id = $meta->vs_id;
                        $team_title = $meta->team_title;
                        $status_code = VSStatus::INVITED_APPROVED;
                        $this->vsRepository->update_status($vs_id, $team_title, $status_code);
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_VS_INVITER_ACCEPT : {
                        $vs_id = $meta->vs_id;
                        $team_title = $meta->team_title;
                        $status_code = VSStatus::INVITER_APPROVED;
                        $this->vsRepository->update_status($vs_id, $team_title, $status_code);
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_ASTROTURF_RESERVATION : {
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_E_COMMERCE_BUY_PRODUCT : {
                        break;
                    }
                    default: break;
                }
                $message = PayfullHelper::get_message($data);

                $response = [
                    'status' => $data['status'],
                    'ErrorMSG' => $message,
                ];

                return view('payment.payfull_response', compact('response'));
            } else {
                echo 'confirmed';
                exit;
            }
        }


    }
}
