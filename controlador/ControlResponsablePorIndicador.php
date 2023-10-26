<?php
class ControlResponsablePorIndicador
{
    var $objResponsablePorIndicador;

    function __construct($objResponsablePorIndicador)
    {
        $this->objResponsablePorIndicador = $objResponsablePorIndicador;
    }

    function guardar()
    {
        $fkidResponsable = $this->objResponsablePorIndicador->getfkidResponsable();
        $fkIdIndicador = $this->objResponsablePorIndicador->getfkIdIndicador();
        $comando = "insert into responsablesporindicador(fkIdIndicador,fkidResponsable) values('$fkIdIndicador','$fkidResponsable')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd(
            $GLOBALS['serv'],
            $GLOBALS['usua'],
            $GLOBALS['pass'],
            $GLOBALS['bdat'],
            $GLOBALS['port']
        );
        $objControlConexion->ejecutarComandoSql($comando);
        $objControlConexion->cerrarBd();
    }

    function listarresponsable_indicador($fkidResponsable)
    {
        $comandoSql = "SELECT actor.nombre,
         responsablesporindicador.fkidindicador 
         FROM actor
         JOIN responsablesporindicador 
         ON responsablesporindicador.fkidresponsable=actor.id 
         JOIN indicador 
         ON responsablesporindicador.fkidindicador = indicador.id 
         WHERE actor.id = '$fkidResponsable'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloResponindic = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objactor = new actor(0, "","");
                $objactor->setNombreActor($row['nombreactor']);
                $objIndicador = new indicador(0, "","","","","");
                $objIndicador->setNombreIndicador($row['nombreindicador']);                
                $arregloResponindic[$i] = $objactor." ".$objIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloResponindic;
    }
}
