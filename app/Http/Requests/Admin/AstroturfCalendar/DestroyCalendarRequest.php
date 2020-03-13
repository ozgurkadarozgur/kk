<?php

namespace App\Http\Requests\Admin\AstroturfCalendar;

use Illuminate\Foundation\Http\FormRequest;

class DestroyCalendarRequest extends FormRequest
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
            'calendar_id' => 'required',
        ];
    }
}
