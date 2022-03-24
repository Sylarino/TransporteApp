<?php

namespace App\Http\Internal\Driver\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverShiftRacesRequest extends FormRequest
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
            'mobile_id' => 'required',
            'shift_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'mobile_id.required' => 'Seleccione un movil',
            'shift_id.required' => 'Seleccione un turno'
        ];
    }
}
