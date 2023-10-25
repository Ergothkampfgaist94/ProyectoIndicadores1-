<?php

class ControlSentido
{

    var $objSentido;

    function __construct($objSentido)
    {
        $this->objSentido = $objSentido;
    }

    function guardar()
    {
        $idSentido = $this->objSentido->getIdSentido();
        $nombreSentido = $this->objSentido->getNombreSentido();
        $comandoSql = "INSERT INTO Sentido(id,nombre) VALUES ('$idSentido', '$nombreSentido')";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function consultar()
    {
        $idSentido = $this->objSentido->getIdSentido();
        $comandoSql = "SELECT * FROM Sentido WHERE id = '$idSentido'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $this->objSentido->setNombreSentido($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objSentido;
    }

    function modificar()
    {
        $idSentido = $this->objSentido->getIdSentido();
        $nombreSentido = $this->objSentido->getNombreSentido();
        $comandoSql = "UPDATE Sentido SET nombre='$nombreSentido' WHERE id = '$idSentido'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function borrar()
    {
        $idSentido = $this->objSentido->getIdSentido();
        $comandoSql = "DELETE FROM Sentido WHERE id = '$idSentido'";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM Sentido";
        $objControlConexion = new ControlConexion();
        $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
        $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
        if (mysqli_num_rows($recordSet) > 0) {
            $arregloSentido = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objSentido = new Sentido("", "");
                $objSentido->setIdSentido($row['id']);
                $objSentido->setNombreSentido($row['nombre']);
                $arregloSentido[$i] = $objSentido;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloSentido;
    }
}
