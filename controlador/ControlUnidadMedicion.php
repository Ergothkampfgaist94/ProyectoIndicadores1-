<?php

class ControlUnidadMedicion
{

    var $objUnidadMedicion;

    function __construct($objUnidadMedicion)
    {
        $this->objUnidadMedicion = $objUnidadMedicion;
    }

    function guardar()
    {
        $idUnidadMedicion = $this->objUnidadMedicion->getIdUnidadMedicion();
        $descripcionUnidadMedicion = $this->objUnidadMedicion->getdescripcionUnidadMedicion();
        $comandoSql = "INSERT INTO UnidadMedicion(id,descripcion) VALUES ('$idUnidadMedicion', '$descripcionUnidadMedicion')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function consultar()
    {
        $idUnidadMedicion = $this->objUnidadMedicion->getIdUnidadMedicion();
        $comandoSql = "SELECT * FROM UnidadMedicion WHERE id = '$idUnidadMedicion'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objUnidadMedicion->setdescripcionUnidadMedicion($row['descripcion']);
        }
        $objControlConexion->cerrarBd();
        return $this->objUnidadMedicion;
    }

    function modificar()
    {
        $idUnidadMedicion = $this->objUnidadMedicion->getIdUnidadMedicion();
        $descripcionUnidadMedicion = $this->objUnidadMedicion->getdescripcionUnidadMedicion();
        $comandoSql = "UPDATE UnidadMedicion SET descripcion='$descripcionUnidadMedicion' WHERE id = '$idUnidadMedicion'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar()
    {
        $idUnidadMedicion = $this->objUnidadMedicion->getIdUnidadMedicion();
        $comandoSql = "DELETE FROM UnidadMedicion WHERE id = '$idUnidadMedicion'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM UnidadMedicion";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloUnidadMedicion = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objUnidadMedicion = new UnidadMedicion("", "");
                $objUnidadMedicion->setIdUnidadMedicion($row['id']);
                $objUnidadMedicion->setdescripcionUnidadMedicion($row['descripcion']);
                $arregloUnidadMedicion[$i] = $objUnidadMedicion;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloUnidadMedicion;
    }
}
