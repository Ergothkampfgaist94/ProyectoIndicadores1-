<?php
class TipoIndicador
{
    var $id, $nombre;

    function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    function setIdTipoIndicador($id)
    {
        $this->id = $id;
    }

    function getIdTipoIndicador()
    {
        return $this->id;
    }

    function setNombreTipoIndicador($nombre)
    {
        $this->nombre = $nombre;
    }

    function getNombreTipoIndicador()
    {
        return $this->nombre;
    }
}
