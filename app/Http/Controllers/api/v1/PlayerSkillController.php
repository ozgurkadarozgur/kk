<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlayerSkill\PlayerSkillResource;
use App\Repositories\Interfaces\IPlayerSkillRepository;
use Illuminate\Http\Request;

class PlayerSkillController extends Controller
{

    private $playerSkillRepository;

    public function __construct(IPlayerSkillRepository $playerSkillRepository)
    {
        $this->playerSkillRepository = $playerSkillRepository;
    }

    public function index()
    {
        $skills = $this->playerSkillRepository->all();
        return response()->json([
            'status' => 'success',
            'data' => PlayerSkillResource::collection($skills),
        ]);
    }
}
