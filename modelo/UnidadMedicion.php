<?php
class UnidadMedicion
{
	var $idUnidadMedicion, $descripcionUnidadMedicion;

	function __construct($idUnidadMedicion, $descripcionUnidadMedicion)
	{
		$this->idUnidadMedicion = $idUnidadMedicion;
		$this->descripcionUnidadMedicion = $descripcionUnidadMedicion;
	}

	function setidUnidadMedicion($idUnidadMedicion)
	{
		$this->idUnidadMedicion = $idUnidadMedicion;
	}

	function getidUnidadMedicion()
	{
		return $this->idUnidadMedicion;
	}

	function setdescripcionUnidadMedicion($descripcionUnidadMedicion)
	{
		$this->descripcionUnidadMedicion = $descripcionUnidadMedicion;
	}

	function getdescripcionUnidadMedicion()
	{
		return $this->descripcionUnidadMedicion;
	}
}
