<?php

namespace App\Http\Requests\Api\PlayerAstroturfReservation;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerAstroturfReservationRequest extends FormRequest
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
            'start_date' => 'required',
            'end_date' => 'required',
            'card.holderName' => 'required',
            'card.cardNumber' => 'required',
            'card.expireMonth' => 'required',
            'card.expireYear' => 'required',
            'card.cvc' => 'required',
        ];
    }
}
