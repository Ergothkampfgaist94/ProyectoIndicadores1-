<?php
class TipoActor
{
    var $idTipoActor, $nombreTipoActor;

    function __construct($idTipoActor, $nombreTipoActor)
    {
        $this->idTipoActor = $idTipoActor;
        $this->nombreTipoActor = $nombreTipoActor;
    }

    function setidTipoActor($idTipoActor)
    {
        $this->idTipoActor = $idTipoActor;
    }

    function getidTipoActor()
    {
        return $this->idTipoActor;
    }

    function setnombreTipoActor($nombreTipoActor)
    {
        $this->nombreTipoActor = $nombreTipoActor;
    }

    function getnombreTipoActor()
    {
        return $this->nombreTipoActor;
    }
}
