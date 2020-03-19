<?php

namespace App\Http\Requests\Admin\League;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeagueRequest extends FormRequest
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
            'facility_id' => 'required',
            'title' => 'required',
            'start_date' => 'required',
            'max_team_count' => 'required',
            'week_count' => 'required',
            'min_player_count' => 'required',
            'cost' => 'required',
            'award_key' => 'required',
            'award_title' => 'required',
        ];
    }
}
