<?php

namespace App\Http\Resources\SIRIN;

use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudResource extends JsonResource
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
            'id_solicitud' => $this->id,
            'codigo' => $this->codigo,
            'descripcion' => $this->descripcion,
            'id_solicitante' => $this->id_user,
            'solicitante' => isset($this->usuario)?$this->usuario:'',
            'id_tecnico' => $this->id_tecnico,
            'estado' => $this->estado,
            'tecnico' => isset($this->tecnico_name)?$this->tecnico_name:'',
            'mail_tec' => isset($this->email)?$this->email:'',
            'created_at' => $this->created_at,
            'codigo_estado' => isset($this->ecodigo)?$this->ecodigo:'',
            'codigo_descripcion' => isset($this->estado)?$this->estado:'',
            'color' => isset($this->color)?$this->color:'',
            'categoria' =>isset( $this->categoria)?$this->categoria:'',
            'prioridad' => isset($this->prioridad)?$this->prioridad:'',
            'file' => isset($this->nombre)?$this->nombre:'',
            'path' => isset($this->path)?public_path('upload')."\\".$this->path:'',
        ];
    }
}
