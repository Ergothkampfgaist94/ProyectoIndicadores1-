<?php
class Variable
{
    var $idVariableIndicador,
        $fkIdVariable,
        $fkIdIndicador,
        $dato,
        $fkEmailUsuario,
        $fechaDato;

    function __construct($fkIdVariable, $fkIdIndicador, $fkEmailUsuario, $dato)
    {
        $this->idVariableIndicador = null;
        $this->fkIdIndicador = $fkIdIndicador;
        $this->fkIdVariable = $fkIdVariable;
        $this->fkEmailUsuario = $fkEmailUsuario;
        $this->dato = $dato;
        $this->idVariableIndicador = getlastmod();
    }
}
