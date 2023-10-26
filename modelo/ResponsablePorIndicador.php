<?php
class ResponsablePorIndicador
{
    var $fkidResponsable;
    var $fkIdIndicador;
    var $fecha;

    function __construct($fkidResponsable, $fkIdIndicador)
    {
        $this->fkidResponsable = $fkidResponsable;
        $this->fkIdIndicador = $fkIdIndicador;
        $this->fecha = getlastmod();
    }

    function setfkidResponsable($fkidResponsable)
    {
        $this->fkidResponsable = $fkidResponsable;
    }

    function getfkidResponsable()
    {
        return $this->fkidResponsable;
    }

    function setfkIdIndicador($fkIdIndicador)
    {
        $this->fkIdIndicador = $fkIdIndicador;
    }

    function getfkIdIndicador()
    {
        return $this->fkIdIndicador;
    }
    function getFecha()
    {
        return $this->fecha;
    }
}
