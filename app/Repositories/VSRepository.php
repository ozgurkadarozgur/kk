<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 08.03.2020
 * Time: 17:13
 */

namespace App\Repositories;


use App\Models\Team;
use App\Models\VS;
use App\Models\VSStatus;
use App\Models\VSStatusLog;
use App\Repositories\Interfaces\IVSRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VSRepository implements IVSRepository
{

    public function findById(int $id): ?VS
    {
        try {
            $vs = VS::findOrFail($id);
            return $vs;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $vs_list = VS::all();
            return $vs_list;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?VS
    {
        try {
            DB::beginTransaction();

            $vs = new VS();
            $vs->inviter_id = $data['inviter_id'];
            $vs->inviter_team_id = $data['inviter_team_id'];
            $vs->invited_id = $data['invited_id'];
            $vs->invited_team_id = $data['invited_team_id'];
            $vs->astroturf_id = $data['astroturf_id'];
            $vs->status_code = VSStatus::WAITING_FOR_APPROVAL;
            $vs->cost = $data['cost'];
            $vs->start_date = $data['start_date'];
            $vs->end_date = $data['end_date'];
            $vs->save();

            $team = Team::findOrFail($data['inviter_team_id']);

            $log = new VSStatusLog();
            $log->vs_id = $vs->id;
            $log->status_code = VSStatus::WAITING_FOR_APPROVAL;
            $log->text = VSStatus::get_status_message(VSStatus::WAITING_FOR_APPROVAL, $team->title);
            $log->save();
            DB::commit();
            return $vs;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            DB::rollBack();
            return null;
        }
    }

    public function incoming_vs_requests(int $player_id): Collection
    {
        // TODO: Implement incoming_vs_requests() method.
    }

    public function incoming_vs_requests_paginate(int $player_id, int $count): LengthAwarePaginator
    {
        try {
            $incoming_vs_requests = VS::where('invited_id', $player_id)->paginate($count);
            return $incoming_vs_requests;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function outgoing_vs_requests(int $player_id): Collection
    {
        // TODO: Implement outgoing_vs_requests() method.
    }

    public function outgoing_vs_requests_paginate(int $player_id, int $count): LengthAwarePaginator
    {
        try {
            $outgoing_vs_requests = VS::where('inviter_id', $player_id)->paginate($count);
            return $outgoing_vs_requests;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function update_status(int $vs_id, $team_title, $status_code): ?VS
    {
        try {
            DB::beginTransaction();

            $vs = $this->findById($vs_id);
            $vs->status_code = $status_code;
            $vs->save();

            $log = new VSStatusLog();
            $log->vs_id = $vs_id;
            $log->status_code = $status_code;
            $log->text = VSStatus::get_status_message($status_code, $team_title);
            $log->save();

            DB::commit();

            return $vs;
        } catch (\Exception $ex) {
            if  (env('APP_DEBUG')) dd($ex);
            DB::rollBack();
            return null;
        }
    }
}