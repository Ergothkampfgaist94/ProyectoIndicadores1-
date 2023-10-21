<?php
class Indicador
{
    var $id;
    var $nombre;

    function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
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
}
