<?php

namespace App\Http\Requests\Api\Elimination;

use Illuminate\Foundation\Http\FormRequest;

class ApplyForEliminationRequest extends FormRequest
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
            'team_id' => 'required|exists:teams,id',
            'card.holderName' => 'required',
            'card.cardNumber' => 'required',
            'card.expireMonth' => 'required',
            'card.expireYear' => 'required',
            'card.cvc' => 'required',
        ];
    }
}
