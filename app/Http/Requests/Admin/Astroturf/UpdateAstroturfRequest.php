<?php

namespace App\Http\Requests\Admin\Astroturf;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAstroturfRequest extends FormRequest
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
            'city' => 'required',
            'district' => 'required',
            'title' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'price' => 'required',
            'work_hour_start' => 'required',
            'work_hour_end' => 'required',
            'services' => 'required',
        ];
    }
}
