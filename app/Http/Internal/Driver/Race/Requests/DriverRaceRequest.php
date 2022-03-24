<?php

namespace App\Http\Internal\Driver\Race\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverRaceRequest extends FormRequest
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


    public function rules()
    {
        return [
            'start_time_hour' => 'required',
            'end_time_hour' => 'required',
            'passengers' => 'required',
            'passengers_count' => 'required',
            'start_mileage' => 'required',
            'end_mileage' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'start_time_hour.required' => 'Ingrese Hora de Inicio',
            'end_time_hour.required' => 'Ingrese Hora de Termino',
            'passengers.required' => 'Ingrese solicitante',
            'passengers_count.required' => 'Requerido',
            'start_mileage.required' => 'Ingrese Kilometraje de inicio',
            'end_mileage.required' => 'Ingrese Kilometraje de Termino'
        ];
    }
}
