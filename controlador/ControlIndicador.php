<?php
class ControlIndicador
{
    var $objIndicador;
    function conectar($comandoSql)
    {
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

    function __construct($objIndicador)
    {
        $this->objIndicador = $objIndicador;
    }

    function guardar()
    {
        $nom = $this->objIndicador->getNombre();
        $comandoSql = "insert into indicador(nombre) values('$nom')";
        $conectar = $this->conectar($comandoSql);
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
                $objIndicador = new Indicador(0, "");
                $objIndicador->setIdIndicador($row['id']);
                $objIndicador->setNombreIndicador($row['nombre']);
                $arregloIndicadores[$i] = $objIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloIndicadores;
    }
}
