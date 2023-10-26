<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlVariable.php';
include '../controlador/ControlUsuario.php';
include '../modelo/Variable.php';
include '../modelo/Usuario.php';
$boton = "";
$idVariable = "";
$nombreVariable = "";
$listbox1 = array();
$objControlUsuario = new ControlUsuario(null);
$arregloUsuario = $objControlUsuario->listar();
$objControlVariable = new ControlVariable(null);
$arregloVariable = $objControlVariable->listar();
if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtid'])) $idVariable = $_POST['txtid'];
if (isset($_POST['txtNombreVariable'])) $nombreVariable = $_POST['txtNombreVariable'];
if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
switch ($boton) {
    case 'Guardar':
        if ($listbox1 != "") {
            for ($i = 0; $i < count($listbox1); $i++) {
                $cadenas = explode(". ", $listbox1[$i]);
                $emailusuario = $cadenas[0];
                $objVariable = new Variable($idVariable, $nombreVariable, $emailusuario);
                $objControlVariable = new ControlVariable($objVariable);
                $objControlVariable->guardar();
            }
        }
        header('Location: vistaVariable.php');
        break;
    case 'Consultar':
        $objVariable = new Variable($idVariable, "", "");
        $objControlVariable = new ControlVariable($objVariable);
        $objControlVariable = $objControlVariable->consultar();
        $nombreVariable = $objVariable->getnombreVariable();
        break;
    case 'Modificar':
        $objVariable = new Variable($idVariable, $nombreVariable, "");
        $objControlVariable = new ControlVariable($objVariable);
        $objControlVariable->modificar();
        header('Location: vistaVariable.php');
        break;
    case 'Borrar':
        $objVariable = new Variable($idVariable, "", "");
        $objControlVariable = new ControlVariable($objVariable);
        $objControlVariable->borrar();
        header('Location: vistaVariable.php');
        break;

    default:

        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Actor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vista/css/misCss.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="../vista/js/misFunciones.js"></script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="miEstilo">Gestión <b>Variable</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión Variable</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>ID</th>
                            <th>Nombre Variable</th>
                            <th>Email Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloVariable); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloVariable[$i]->getidVariable(); ?></td>
                                <td><?php echo $arregloVariable[$i]->getnombreVariable(); ?></td>
                                <td><?php echo $arregloVariable[$i]->getfkEmailUsuario(); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- crud Modal HTML -->
    <div id="crudModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="vistaActor.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Tipo Variable</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="id" id="txtid" name="txtid" class="form-control" value="<?php echo $idVariable ?>">
                        </div>
                        <div class="form-group">
                            <label>Nombre Variable</label>
                            <input type="text" id="txtNombreVariable" name="txtNombreVariable" class="form-control" value="<?php echo $nombreVariable ?>">
                        </div>
                        <div class="container">
                            <div class="form-group">
                                <label for="combobox1">Tipos de Variables</label>
                                <select class="form-control" id="combobox1" name="combobox1">
                                    <?php for ($i = 0; $i < count($arregloUsuario); $i++) { ?>
                                        <option value="<?php echo $arregloUsuario[$i]->getEmail(); ?>">
                                            <?php echo $arregloUsuario[$i]->getEmail(); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <br>
                                <label for="listbox1">Emails específicos del usuario</label>
                                <select multiple class="form-control" id="listbox1" name="listbox1[]">

                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1', 'listbox1')">Agregar Item</button>
                                <button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1')">Remover Item</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
                            <input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
                            <input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
                            <input type="submit" id="btnBorrar" name="bt" class="btn btn-warning" value="Borrar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>