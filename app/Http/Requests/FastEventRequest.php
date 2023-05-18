<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FastEventRequest extends FormRequest
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
            'start' => 'date_format:H:i:s|before:end',
            'end' => 'date_format:H:i:s|after:start',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Complete el campo Título del evento',
            'title.min' => '¡El título del evento debe tener al menos 3 caracteres!',
            'start.date_format' => '¡Complete la hora de inicio con un valor válido!',
            'start.before' => '¡La hora de inicio debe ser menor que la hora de finalización!',
            'end.date_format' => '¡Complete la hora de finalización con un valor válido!',
            'end.after' => '¡La hora de finalización debe ser mayor que la hora de inicio!',
        ];
    }
}
