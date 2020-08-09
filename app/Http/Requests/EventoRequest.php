<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_solicitud' => 'required',
            'id_tecnico' => 'required',
            'id_categoria' => 'required'
        ];
    }
    public function messages()
    {
        return[
            'id_solicitud.required' => 'La solicitud es requerida'
        ];
    }
    public function attributes()
    {
        return [
            'id_solicitud' => 'Solicitud a registrar',
            'id_tecnico' => 'Tecnico que produjo el evento',
            'detalle' => 'Detalle del evento',
            'id_categoria' => 'Categoria donde se produjo el evento'
        ];
    }
}
