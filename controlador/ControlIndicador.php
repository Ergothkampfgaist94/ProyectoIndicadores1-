<?php
class ControlIndicador
{
    var $objIndicador;
    function __construct($objIndicador)
    {
        $this->objIndicador = $objIndicador;
    }

    function guardar()
    {
        $nom = $this->objIndicador->getNombreIndicador();
        $comandoSql = "insert into indicador(nombre) values('$nom')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd(
            $GLOBALS['serv'],
            $GLOBALS['usua'],
            $GLOBALS['pass'],
            $GLOBALS['bdat'],
            $GLOBALS['port']
        );
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM indicador";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd(
            $GLOBALS['serv'],
            $GLOBALS['usua'],
            $GLOBALS['pass'],
            $GLOBALS['bdat'],
            $GLOBALS['port']
        );
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloIndicadores = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objIndicador = new Indicador(0,"","","","");
                $objIndicador->setIdIndicador($row['id']);
                $objIndicador->setNombreIndicador($row['nombre']);
                $objIndicador->setCodigo($row['codigo']);
                $objIndicador->setNombreIndicador($row['objetivo']);
                $objIndicador->setNombreIndicador($row['alcance']);
                $arregloIndicadores[$i] = $objIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloIndicadores;
    }
}
