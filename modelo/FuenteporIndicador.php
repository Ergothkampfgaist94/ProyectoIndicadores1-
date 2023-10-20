<?php
class FuenteporIndicador
{
    var $fkIdFuente;
    var $fkIdIndicador;

    function __construct($fkIdFuente, $fkIdIndicador)
    {
        $this->fkIdFuente = $fkIdFuente;
        $this->fkIdIndicador = $fkIdIndicador;
    }

    function setfkIdFuente($fkIdFuente)
    {
        $this->fkIdFuente = $fkIdFuente;
    }

    function getfkIdFuente()
    {
        return $this->fkIdFuente;
    }

    function setfkIdIndicador($fkIdIndicador)
    {
        $this->fkIdIndicador = $fkIdIndicador;
    }

    function getfkIdIndicador()
    {
        return $this->fkIdIndicador;
    }
}
