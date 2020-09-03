<?php

namespace App\Http\Resources\SIRIN;

use Illuminate\Http\Resources\Json\JsonResource;

class EstadoResource extends JsonResource
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
            'id' => $this->id,
            'codigo' => $this->codigo,
            'descripcion' => $this->descripcion,
            'color' => $this->color,
            'creado' => $this->created_at,
        ];
    }
}
