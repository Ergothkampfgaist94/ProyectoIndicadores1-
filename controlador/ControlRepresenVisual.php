<?php

class ControlRepresenVisual
{

    var $objRepresenVisual;

    function __construct($objRepresenVisual)
    {
        $this->objRepresenVisual = $objRepresenVisual;
    }

    function guardar()
    {
        $idRepresenVisual = $this->objRepresenVisual->getIdRepresenVisual();
        $nombreRepresenVisual = $this->objRepresenVisual->getNombreRepresenVisual();
        $comandoSql = "INSERT INTO represenvisual(id,nombre) VALUES ('$idRepresenVisual', '$nombreRepresenVisual')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function consultar()
    {
        $idRepresenVisual = $this->objRepresenVisual->getIdRepresenVisual();
        $comandoSql = "SELECT * FROM represenvisual WHERE id = '$idRepresenVisual'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objRepresenVisual->setNombreRepresenVisual($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objRepresenVisual;
    }

    function modificar()
    {
        $idRepresenVisual = $this->objRepresenVisual->getIdRepresenVisual();
        $nombreRepresenVisual = $this->objRepresenVisual->getNombreRepresenVisual();
        $comandoSql = "UPDATE represenvisual SET nombre='$nombreRepresenVisual' WHERE id = '$idRepresenVisual'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar()
    {
        $idRepresenVisual = $this->objRepresenVisual->getIdRepresenVisual();
        $comandoSql = "DELETE FROM represenvisual WHERE id = '$idRepresenVisual'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM represenvisual";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloRepresenVisual = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objRepresenVisual = new RepresenVisual("", "");
                $objRepresenVisual->setIdRepresenVisual($row['id']);
                $objRepresenVisual->setNombreRepresenVisual($row['nombre']);
                $arregloRepresenVisual[$i] = $objRepresenVisual;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloRepresenVisual;
    }
}
