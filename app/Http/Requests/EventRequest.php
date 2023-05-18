<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required|min:3',
            'start' => 'date_format:Y-m-d H:i:s|before:end',
            'end' => 'date_format:Y-m-d H:i:s|after:start',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Complete el campo Título del evento!',
            'title.min' => '¡El título del evento debe tener al menos 3 caracteres!',
            'start.date_format' => '¡Ingrese una fecha de inicio con un valor válido!',
            'start.before' => 'A Data/Hora Inicial deve ser menor que a Data Final!',
            'end.date_format' => '¡La fecha/hora de inicio debe ser anterior a la fecha de finalización!',
            'end.after' => '¡La fecha/hora de finalización debe ser posterior a la fecha de inicio!',
        ];
    }

}
