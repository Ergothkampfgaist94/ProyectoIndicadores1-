<?php
class Actor
{
    var $idActor, $nombreActor,$fkidTipoActor;

    function __construct($idActor, $nombreActor)
    {
        $this->idActor = $idActor;
        $this->nombreActor = $nombreActor;
        $this->fkidTipoActor = null;
    }

    function setIdActor($idActor)
    {
        $this->idActor = $idActor;
    }

    function getIdActor()
    {
        return $this->idActor;
    }

    function setNombreActor($nombreActor)
    {
        $this->nombreActor = $nombreActor;
    }

    function getNombreActor()
    {
        return $this->nombreActor;
    }
    function setfkidTipoActor($fkidTipoActor)
    {
        $this->fkidTipoActor = $fkidTipoActor;
    }

    function getfkidTipoActor()
    {
        return $this->fkidTipoActor;
    }
}
