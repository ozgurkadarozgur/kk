<?php

namespace App\Http\Requests\Api\VS;

use Illuminate\Foundation\Http\FormRequest;

class VSRequest extends FormRequest
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
            'inviter_team_id' => 'required|exists:teams,id',
            'invited_team_id' => 'required|exists:teams,id',
            'astroturf_id' => 'required|exists:astroturfs,id',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
