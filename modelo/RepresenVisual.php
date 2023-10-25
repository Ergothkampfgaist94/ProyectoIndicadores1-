<?php
class RepresenVisual
{
    var $idRepresenVisual, $nombreRepresenVisual;

    function __construct($idRepresenVisual, $nombreRepresenVisual)
    {
        $this->idRepresenVisual = $idRepresenVisual;
        $this->nombreRepresenVisual = $nombreRepresenVisual;
    }

    function setIdRepresenVisual($idRepresenVisual)
    {
        $this->idRepresenVisual = $idRepresenVisual;
    }

    function getIdRepresenVisual()
    {
        return $this->idRepresenVisual;
    }

    function setNombreRepresenVisual($nombreRepresenVisual)
    {
        $this->nombreRepresenVisual = $nombreRepresenVisual;
    }

    function getNombreRepresenVisual()
    {
        return $this->nombreRepresenVisual;
    }
}
