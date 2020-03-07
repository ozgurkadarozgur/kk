<?php
/**
 * Created by PhpStorm.
 * User: ozgur
 * Date: 07.03.2020
 * Time: 17:37
 */

namespace App\Repositories;


use App\Models\PlayerSkill;
use App\Repositories\Interfaces\IPlayerSkillRepository;
use Illuminate\Support\Collection;

class PlayerSkillRepository implements IPlayerSkillRepository
{

    public function findById(int $id): ?PlayerSkill
    {
        try {
            $skill = PlayerSkill::findOrFail($id);
            return $skill;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function all(): Collection
    {
        try {
            $skills = PlayerSkill::all();
            return $skills;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }

    public function create($data): ?PlayerSkill
    {
        try {
            $skill = new PlayerSkill();
            $skill->title = $data['title'];
            $skill->save();
            return $skill;
        } catch (\Exception $ex) {
            if (env('APP_DEBUG')) dd($ex);
            return null;
        }
    }
}