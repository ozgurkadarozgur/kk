<?php

namespace App\Http\Requests\Api\Account;

use Illuminate\Foundation\Http\FormRequest;

class SignUpValidate1 extends FormRequest
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
            'full_name' => 'required|min:6',
            'phone' => 'required|phone:TR,mobile|unique:players,phone',
            'email' => 'required|email|unique:players,email',
            'password' => 'required|confirmed|min:6',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
        ];
    }
}
