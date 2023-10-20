<?php
class ControlFuenteporIndicador
{
    var $objFuenteporIndicador;
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

    function __construct($objFuenteporIndicador)
    {
        $this->objFuenteporIndicador = $objFuenteporIndicador;
    }

    function guardar()
    {
        $fkIdFuente = $this->objFuenteporIndicador->getfkIdFuente();
        $fkIdIndicador = $this->objFuenteporIndicador->getfkIdIndicador();
        $comandoSql = "insert into fuentesporindicador(fkidFuente,fkidIndicador) values('$fkIdFuente',$fkIdIndicador)";
        $conectar = $this->conectar($comandoSql);
    }

    function listarRolesDelUsuario($fkidFuente)
    {
        $comandoSql = "SELECT fuentesporindicador.fkidIndicador,fuente.nombre 
            FROM fuentesporindicador INNER JOIN fuente ON fuentesporindicador.fkidIndicador = fuente.id
            WHERE fkidFuente = '$fkidFuente'";
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
                $objRol = new Indicador(0, "");
                $objRol->setId($row['id']);
                $objRol->setNombre($row['nombre']);
                $arregloIndicadores[$i] = $objRol;
                $i++;
            }
        }
        $objControlConexion->cerrarBd();
        return $arregloIndicadores;
    }
}
