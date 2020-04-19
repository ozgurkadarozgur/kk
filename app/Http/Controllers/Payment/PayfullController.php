<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\PayfullHelper;
use App\Http\Controllers\Controller;
use App\Models\VSStatus;
use App\Repositories\Interfaces\IEliminationApplicationRepository;
use App\Repositories\Interfaces\ILeagueApplicationRepository;
use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\IPlayerAstroturfReservationRepository;
use App\Repositories\Interfaces\IVSRepository;

class PayfullController extends Controller
{
    private $leagueApplicationRepository;
    private $eliminationApplicationRepository;
    private $vsRepository;
    private $playerAstroturfReservationRepository;
    private $orderRepository;

    public function __construct(ILeagueApplicationRepository $leagueApplicationRepository, IEliminationApplicationRepository $eliminationApplicationRepository, IVSRepository $vsRepository, IPlayerAstroturfReservationRepository $playerAstroturfReservationRepository, IOrderRepository $orderRepository)
    {
        $this->leagueApplicationRepository = $leagueApplicationRepository;
        $this->eliminationApplicationRepository = $eliminationApplicationRepository;
        $this->vsRepository = $vsRepository;
        $this->playerAstroturfReservationRepository = $playerAstroturfReservationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function handle_response()
    {
        $data = $_POST;

        if ($data['status'] == 1) {
            if ($data['confirm_action'] == 0) {
                $meta = json_decode($data['passive_data']);
                $process_type = $meta->process_type;
                switch ($process_type) {
                    case PayfullHelper::PROCESS_TYPE_LEAGUE_APPLICATION : {
                        $league_id = $meta->league_id;
                        $db_data = [
                            'player_id' => $meta->player_id,
                            'team_id' => $meta->team_id,
                        ];
                        $this->leagueApplicationRepository->apply($league_id, $db_data);
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_ELIMINATION_APPLICATION : {
                        $elimination_id = $meta->elimination_id;
                        $db_data = [
                            'player_id' => $meta->player_id,
                            'team_id' => $meta->team_id,
                        ];
                        $this->eliminationApplicationRepository->apply($elimination_id, $db_data);
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
                        $db_data = [
                            'player_id' => $meta->player_id,
                            'astroturf_id' => $meta->astroturf_id,
                            'start_date' => $meta->start_date,
                            'end_date' => $meta->end_date,
                        ];
                        $this->playerAstroturfReservationRepository->create($db_data);
                        break;
                    }
                    case PayfullHelper::PROCESS_TYPE_E_COMMERCE_BUY_PRODUCT : {
                        $db_data = [
                            'user_id' => $meta->player_id,
                            'total' => $data['total'],
                            'address' => $meta->address,
                            'items' => $meta->products,
                        ];
                        dd($db_data);
                        $this->orderRepository->create($db_data);
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
