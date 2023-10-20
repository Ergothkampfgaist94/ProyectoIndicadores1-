<?php
class ControlRol
{
    var $objRol;
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

    function __construct($objRol)
    {
        $this->objRol = $objRol;
    }

    function guardar()
    {
        $nom = $this->objRol->getNombre();
        $comandoSql = "insert into rol(nombre) values('$nom')";
        $conectar = $this->conectar($comandoSql);
    }

    function listar()
    {
        $comandoSql = "SELECT * FROM rol";
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
            $arregloRoles = array();
            $i = 0;
            while ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
                $objRol = new Rol(0, "");
                $objRol->setId($row['id']);
                $objRol->setNombre($row['nombre']);
                $arregloRoles[$i] = $objRol;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloRoles;
    }
}