<?php

class ControlTipoIndicador
{

    var $objControlTipoIndicador;
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

    function __construct($objControlTipoIndicador)
    {
        $this->objControlTipoIndicador = $objControlTipoIndicador;
    }

    function guardar()
    {
        $IdTipoIndicador = $this->objControlTipoIndicador->getIdTipoIndicador();
        $nombreTipoIndicador = $this->objControlTipoIndicador->getnombreTipoIndicador();
        $comandoSql = "INSERT INTO tipoindicador(id,nombre) VALUES ('$IdTipoIndicador', '$nombreTipoIndicador')";
        $conectar = $this->conectar($comandoSql);
    }

    function consultar()
    {
        $IdTipoIndicador = $this->objControlTipoIndicador->getIdTipoIndicador();

        $comandoSql = "SELECT * FROM tipoindicador WHERE id = '$IdTipoIndicador'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd(
            $GLOBALS['serv'],
            $GLOBALS['usua'],
            $GLOBALS['pass'],
            $GLOBALS['bdat'],
            $GLOBALS['port']
        );
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objControlTipoIndicador->setnombreTipoIndicador($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objControlTipoIndicador;
    }

    function modificar()
    {
        $IdTipoIndicador = $this->objControlTipoIndicador->getIdTipoIndicador();
        $nombreTipoIndicador = $this->objControlTipoIndicador->getnombreTipoIndicador();
        $comandoSql = "UPDATE tipoindicador SET nombre='$nombreTipoIndicador' WHERE id = '$IdTipoIndicador'";
        $conectar = $this->conectar($comandoSql);
    }

    function borrar()
    {
        $IdTipoIndicador = $this->objControlTipoIndicador->getIdTipoIndicador();
        $comandoSql = "DELETE FROM tipoindicador WHERE id = '$IdTipoIndicador'";
        $conectar = $this->conectar($comandoSql);
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM tipoindicador";
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
            $arregloTipoIndicador = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objTipoIndicador = new TipoIndicador("", "");
                $objTipoIndicador->setIdTipoIndicador($row['id']);
                $objTipoIndicador->setnombreTipoIndicador($row['nombre']);
                $arregloTipoIndicador[$i] = $objTipoIndicador;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloTipoIndicador;
    }
}
