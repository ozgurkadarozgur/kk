<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 21:11
 */

namespace App\Repositories;


use App\Models\TeamMember;
use App\Repositories\Interfaces\ITeamMemberRepository;
use Illuminate\Support\Collection;

class TeamMemberRepository implements ITeamMemberRepository
{

    public function findById(int $id): ?TeamMember
    {
        try {
            $member = TeamMember::findOrFail($id);
            return $member;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $members = TeamMember::all();
            return $members;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?TeamMember
    {
        try {
            $member = new TeamMember();
            $member->team_id = $data['team_id'];
            $member->position_id = $data['position_id'];
            $member->full_name = $data['full_name'];
            $member->power = $data['power'];
            $member->save();
            return $member;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function destroy(int $id): ?TeamMember
    {
        try {
            $member = $this->findById($id);
            $member->delete();
            return $member;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}