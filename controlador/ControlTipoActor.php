<?php

class ControlTipoActor
{

    var $objTipoActor;

    function __construct($objTipoActor)
    {
        $this->objTipoActor = $objTipoActor;
    }

    function guardar()
    {
        $idTipoActor = $this->objTipoActor->getIdTipoActor();
        $nombreTipoActor = $this->objTipoActor->getNombreTipoActor();
        $comandoSql = "INSERT INTO TipoActor(id,nombre) VALUES ('$idTipoActor', '$nombreTipoActor')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function consultar()
    {
        $idTipoActor = $this->objTipoActor->getIdTipoActor();
        $comandoSql = "SELECT * FROM TipoActor WHERE id = '$idTipoActor'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objTipoActor->setNombreTipoActor($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objTipoActor;
    }

    function modificar()
    {
        $idTipoActor = $this->objTipoActor->getIdTipoActor();
        $nombreTipoActor = $this->objTipoActor->getNombreTipoActor();
        $comandoSql = "UPDATE TipoActor SET nombre='$nombreTipoActor' WHERE id = '$idTipoActor'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar()
    {
        $idTipoActor = $this->objTipoActor->getIdTipoActor();
        $comandoSql = "DELETE FROM TipoActor WHERE id = '$idTipoActor'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM TipoActor";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloTipoActor = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objTipoActor = new TipoActor("", "");
                $objTipoActor->setIdTipoActor($row['id']);
                $objTipoActor->setNombreTipoActor($row['nombre']);
                $arregloTipoActor[$i] = $objTipoActor;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloTipoActor;
    }
}
