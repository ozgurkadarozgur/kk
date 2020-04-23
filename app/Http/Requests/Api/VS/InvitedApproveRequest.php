<?php

namespace App\Http\Requests\Api\VS;

use Illuminate\Foundation\Http\FormRequest;

class InvitedApproveRequest extends FormRequest
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
            'card' => 'required',
            'card.holderName' => 'required',
            'card.cardNumber' => 'required',
            'card.expireMonth' => 'required',
            'card.expireYear' => 'required',
            'card.cvc' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'holderName.required' => 'Kart sahibi alanı boş bırakılamaz.',
            'cardNumber.required' => 'Kart numarası alanı boş bırakılamaz.',
            'expireMonth.required' => 'Son kullanma tarihi alanı boş bırakılamaz.',
            'expireYear.required' => 'Son kullanma tarihi alanı boş bırakılamaz.',
            'cvc.required' => 'CVC alanı boş bırakılamaz.',
        ];
    }

}
