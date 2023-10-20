<?php

class ControlFuente
{

    var $objFuente;
    function conectar($comandoSql){
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

    function __construct($objFuente)
    {
        $this->objFuente = $objFuente;
    }

    function guardar()
    {
        $idFuente = $this->objFuente->getIdFuente();
        $nombreFuente = $this->objFuente->getNombreFuente();
        $comandoSql = "INSERT INTO fuente(id,nombre) VALUES ('$idFuente', '$nombreFuente')";
        $conectar = $this->conectar($comandoSql);
    }

    function consultar()
    {
        $idFuente = $this->objFuente->getIdFuente();

        $comandoSql = "SELECT * FROM fuente WHERE id = '$idFuente'";
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
            $this->objFuente->setNombreFuente($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objFuente;
    }

    function modificar()
    {
        $idFuente = $this->objFuente->getIdFuente();
        $nombreFuente = $this->objFuente->getNombreFuente();
        $comandoSql = "UPDATE fuente SET nombre='$nombreFuente' WHERE id = '$idFuente'";
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

    function borrar()
    {
        $idFuente = $this->objFuente->getIdFuente();
        $comandoSql = "DELETE FROM fuente WHERE id = '$idFuente'";
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
        $comandoSql = "SELECT * FROM fuente";
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
            $arregloFuente = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objFuente = new Fuente("", "");
                $objFuente->setvar1($row['id']);
                $objFuente->setvar2($row['nombre']);
                $arregloFuente[$i] = $objFuente;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloFuente;
    }
}
