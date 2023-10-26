<?php

class ControlVariable
{

    var $objVariable;

    function __construct($objVariable)
    {
        $this->objVariable = $objVariable;
    }

    function guardar()
    {
        $idVariable = $this->objVariable->getidVariable();
        $nombreVariable = $this->objVariable->getnombreVariable();
        $fkEmailUsuario = $this->objVariable->getfkEmailUsuario();
        $comandoSql = "INSERT INTO variable(id,nombre,fkemailusuario) VALUES ('$idVariable', '$nombreVariable','$fkEmailUsuario')";
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

    function consultar()
    {
        $idVariable = $this->objVariable->getIdVariable();
        $comandoSql = "SELECT * FROM variable WHERE id = '$idVariable'";
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
            $this->objVariable->setnombreVariable($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objVariable;
    }

    function modificar()
    {
        $idVariable = $this->objVariable->getIdVariable();
        $nombreVariable = $this->objVariable->getNombreVariable();
        $comandoSql = "UPDATE variable SET nombre='$nombreVariable' WHERE id = '$idVariable'";
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
        $idVariable = $this->objVariable->getIdVariable();
        $comandoSql = "DELETE FROM variable WHERE id = '$idVariable'";
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
        $comandoSql = "SELECT * FROM variable";
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
            $arregloVariable = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objVariable = new Variable("", "", "");
                $objVariable->setidVariable($row['id']);
                $objVariable->setnombreVariable($row['nombre']);
                $objVariable->setfkEmailUsuario($row['fkemailusuario']);
                $arregloVariable[$i] = $objVariable;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloVariable;
    }
}
