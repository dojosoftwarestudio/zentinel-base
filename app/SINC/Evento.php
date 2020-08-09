<?php
namespace App\SINC;

class Evento
{
	private $id_solicitud;
	private $categoria;
	private $tecnico;
	private $detalle ;

	function __construct($id_solicitud, $categoria, $tecnico, $detalle = 'Evento de Sistema')
	{
		$this->id_solicitud = $id_solicitud;
		$this->tecnico = $tecnico;
		$this->categoria = $categoria;
		$this->detalle = $detalle;
	}

}