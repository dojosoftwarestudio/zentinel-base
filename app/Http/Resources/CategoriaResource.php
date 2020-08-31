<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
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
            'idCategoria' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'prioridad' => $this->prioridad,
            'publica'=> $this->is_public,
            'created_at' => $this->created_at?$this->created_at->diffForHumans():''

        ];
    }
}
