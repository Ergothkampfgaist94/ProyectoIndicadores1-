<?php
class Fuente
{
    var $idFuente;
    var $nombreFuente;

    function __construct($idFuente, $nombreFuente)
    {
        $this->idFuente = $idFuente;
        $this->nombreFuente = $nombreFuente;
    }

    function setidFuente($idFuente)
    {
        $this->idFuente = $idFuente;
    }

    function getidFuente()
    {
        return $this->idFuente;
    }

    function setnombreFuente($nombreFuente)
    {
        $this->nombreFuente = $nombreFuente;
    }

    function getnombreFuente()
    {
        return $this->nombreFuente;
    }
}
