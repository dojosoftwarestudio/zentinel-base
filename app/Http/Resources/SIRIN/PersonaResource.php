<?php

namespace App\Http\Resources\SIRIN;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'fullname' => $this->nombre.' '.$this->apellido_pat.' '.$this->apellido_mat,
            'nombre' => $this->nombre,
            'paterno' => $this->apellido_pat,
            'materno' => $this->apellido_mat,
            'estado' => $this->estado,
            'creado' => $this->created_at->diffForHumans()

        ];
    }
}
