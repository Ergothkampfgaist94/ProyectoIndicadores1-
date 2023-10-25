<?php
class Sentido
{
    var $idSentido, $nombreSentido;

    function __construct($idSentido, $nombreSentido)
    {
        $this->idSentido = $idSentido;
        $this->nombreSentido = $nombreSentido;
    }

    function setidSentido($idSentido)
    {
        $this->idSentido = $idSentido;
    }

    function getidSentido()
    {
        return $this->idSentido;
    }

    function setnombreSentido($nombreSentido)
    {
        $this->nombreSentido = $nombreSentido;
    }

    function getnombreSentido()
    {
        return $this->nombreSentido;
    }
}
