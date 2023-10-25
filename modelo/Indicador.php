<?php
class Indicador
{
    var $id;
    var $nombre;
    var $codigo;
    var $objetivo;
    var $alcance;

    function __construct($id, $nombre, $codigo, $objetivo, $alcance)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        $this->objetivo = $objetivo;
        $this->alcance = $alcance;
    }

    function setIdIndicador($id)
    {
        $this->id = $id;
    }

    function getIdIndicador()
    {
        return $this->id;
    }

    function setNombreIndicador($nombre)
    {
        $this->nombre = $nombre;
    }

    function getNombreIndicador()
    {
        return $this->nombre;
    }
    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function getCodigo()
    {
        return $this->codigo;
    }
    function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    }

    function getObjetivo()
    {
        return $this->objetivo;
    }
    function setAlcance($alcance)
    {
        $this->alcance = $alcance;
    }

    function getAlcance()
    {
        return $this->alcance;
    }
}
