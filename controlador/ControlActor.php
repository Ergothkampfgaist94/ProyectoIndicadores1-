<?php

class ControlActor
{

    var $objActor;

    function __construct($objActor)
    {
        $this->objActor = $objActor;
    }

    function guardar()
    {
        $idActor = $this->objActor->getIdActor();
        $nombreActor = $this->objActor->getNombreActor();
        $fkidTipoActor = $this->objActor->getfkidTipoActor();
        $comandoSql = "INSERT INTO actor(id,nombre,fkidtipoactor) VALUES ('$idActor', '$nombreActor','$fkidTipoActor')";
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
        $idActor = $this->objActor->getIdActor();
        $comandoSql = "SELECT * FROM actor WHERE id = '$idActor'";
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
            $this->objActor->setNombreActor($row['nombre']);
        }
        $objControlConexion->cerrarBd();
        return $this->objActor;
    }

    function modificar()
    {
        $idActor = $this->objActor->getIdActor();
        $nombreActor = $this->objActor->getNombreActor();
        $comandoSql = "UPDATE actor SET nombre='$nombreActor' WHERE id = '$idActor'";
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
        $idActor = $this->objActor->getIdActor();
        $comandoSql = "DELETE FROM actor WHERE id = '$idActor'";
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
        $comandoSql = "SELECT * FROM actor";
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
            $arregloActor = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objActor = new Actor("", "", "");
                $objActor->setIdActor($row['id']);
                $objActor->setNombreActor($row['nombre']);
                $objActor->setfkidTipoActor($row['fkidtipoactor']);
                $arregloActor[$i] = $objActor;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloActor;
    }
}
