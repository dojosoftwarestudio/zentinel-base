<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource
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
            'id_evento' => $this->id,
            'tecnico' => $this->tecnico,
            'detalle' => $this->detalle,
            'categoria' => $this->categoria,

        ];
    }
}
