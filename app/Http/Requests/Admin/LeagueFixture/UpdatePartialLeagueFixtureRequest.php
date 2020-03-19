<?php

namespace App\Http\Requests\Admin\LeagueFixture;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartialLeagueFixtureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team1_score' => 'nullable|int|min:0',
            'team2_score' => 'nullable|int|min:0',
            'start_date' => 'nullable|date',
            'start_time' => 'nullable',
            'astroturf_id' => 'nullable',
        ];
    }
}
