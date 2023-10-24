<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlFuente.php';
include '../modelo/Fuente.php';
$boton = "";
$idFuente = "";
$nombreFuente = "";
$objControlFuente = new ControlFuente(null);
$arregloFuente = $objControlFuente->listar();
if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtid'])) $idFuente = $_POST['txtid'];
if (isset($_POST['txtNombreFuente'])) $nombreFuente = $_POST['txtNombreFuente'];
switch ($boton) {
    case 'Guardar':
        $objFuente = new Fuente($idFuente, $nombreFuente);
        $objControlFuente = new ControlFuente($objFuente);
        $objControlFuente->guardar();
        header('Location: vistaFuente.php');
        break;
    case 'Consultar':
        $objFuente = new Fuente($idFuente, "");
        $objControlFuente = new ControlFuente($objFuente);
        $objFuente = $objControlFuente->consultar();
        $nombreFuente = $objFuente->getNombreFuente();
        break;
    case 'Modificar':
        $objFuente = new Fuente($idFuente, $nombreFuente);
        $objControlFuente = new ControlFuente($objFuente);
        $objControlFuente->modificar();
        header('Location: vistaFuente.php');
        break;
    case 'Borrar':
        $objFuente = new Fuente($idFuente, "");
        $objControlFuente = new ControlFuente($objFuente);
        $objControlFuente->borrar();
        header('Location: vistaFuente.php');
        break;

    default:
        # code...
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fuentes</title>
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
                            <h2 class="miEstilo">Gestión <b>Fuentes</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión Fuentes</span></a>

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
                            <th>Fuentes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloFuente); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloFuente[$i]->getIdFuente(); ?></td>
                                <td><?php echo $arregloFuente[$i]->getNombreFuente(); ?></td>
                                <td>
                                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- crud Modal HTML -->
    <div id="crudModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="vistaFuente.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Fuentes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>id</label>
                            <input type="id" id="txtid" name="txtid" class="form-control" value="<?php echo $idFuente ?>">
                        </div>
                        <div class="form-group">
                            <label>Fuente</label>
                            <input type="nombreFuente" id="txtNombreFuente" name="txtNombreFuente" class="form-control" value="<?php echo $nombreFuente ?>">
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