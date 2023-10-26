<?php
class Variable
{
    var $idVariable, $nombreVariable, $fechaCreacion, $fkEmailUsuario;

    function __construct($idVariable, $nombreVariable, $fkEmailUsuario)
    {
        $this->idVariable = $idVariable;
        $this->nombreVariable = $nombreVariable;
        $this->fechaCreacion = getlastmod();
        $this->fkEmailUsuario = $fkEmailUsuario;
    }

    function setidVariable($idVariable)
    {
        $this->idVariable = $idVariable;
    }

    function getidVariable()
    {
        return $this->idVariable;
    }

    function setnombreVariable($nombreVariable)
    {
        $this->nombreVariable = $nombreVariable;
    }

    function getnombreVariable()
    {
        return $this->nombreVariable;
    }
    function setfkEmailUsuario($fkEmailUsuario)
    {
        $this->fkEmailUsuario = $fkEmailUsuario;
    }

    function getfkEmailUsuario()
    {
        return $this->fkEmailUsuario;
    }
}
