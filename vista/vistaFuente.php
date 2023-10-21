<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlFuente.php';
include '../controlador/ControlIndicador.php';
include '../controlador/ControlFuenteporIndicador.php';
include '../modelo/Fuente.php';
include '../modelo/Indicador.php';
include '../modelo/FuenteporIndicador.php';
$boton = "";
$id = "";
$nombre = "";
$listbox1 = array();
$objControlFuente = new ControlFuente(null);
$arregloFuente = $objControlFuente->listar();
$objControlIndicador = new ControlIndicador(null);
$arregloIndicadores = $objControlIndicador->listar();
if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtId'])) $id = $_POST['txtId'];
if (isset($_POST['txtNombre'])) $nombre = $_POST['txtNombre'];
if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
switch ($boton) {
    case 'Guardar':
        $objFuente = new Fuente($id, $nombre);
        $objControlFuente = new ControlFuente($objFuente);
        $objControlFuente->guardar();
        if ($listbox1 != "") {
            for ($i = 0; $i < count($listbox1); $i++) {
                $cadenas = explode(";", $listbox1[$i]);
                $id = $cadenas[0];
                $objFuenteporIndicador = new FuenteporIndicador($id, $id);
                $objControlFuenteporIndicador = new ControlFuenteporIndicador($objFuenteporIndicador);
                $objControlFuenteporIndicador->guardar();
            }
        }
        header('Location: vistaFuente.php');
        break;
    case 'Consultar':
        $objFuente = new Fuente($id, "");
        $objControlFuente = new ControlFuente($objFuente);
        $objFuente = $objControlFuente->consultar();
        $nombre = $objFuente->getContrasena();
        $objControlFuenteporIndicador = new ControlFuenteporIndicador(null);
        $arregloIndicadoresConsulta = $objControlFuenteporIndicador->listarFuentesPorIndicador($id);
        break;
    case 'Modificar':
        $objFuente = new Fuente($id, $nombre);
        $objControlFuente = new ControlFuente($objFuente);
        $objControlFuente->modificar();
        header('Location: vistaFuente.php');
        break;
    case 'Borrar':
        $objFuente = new Fuente($id, "");
        $objControlFuente = new ControlFuente($objFuente);
        $objControlFuente->borrar();
        header('Location: vistaFuente.php');
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
    <title>Usuarios</title>
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
                            <h2 class="miEstilo">Gestión <b>Usuarios</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión Usuarios</span></a>

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
                            <th>Acciones</th>
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
                <form action="vistaFuente.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Fuentes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="container">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home">Tipos de Fuentes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu1">Indicadores por Fuentes</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="home" class="container tab-pane active"><br>
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" id="txtId" name="txtId" class="form-control" value="<?php echo $id ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Fuente</label>
                                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" value="<?php echo $nombre ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="btnGuardar" name="bt" class="btn btn-success" value="Guardar">
                                        <input type="submit" id="btnConsultar" name="bt" class="btn btn-success" value="Consultar">
                                        <input type="submit" id="btnModificar" name="bt" class="btn btn-warning" value="Modificar">
                                        <input type="submit" id="btnBorrar" name="bt" class="btn btn-warning" value="Borrar">
                                    </div>
                                </div>
                                <div id="menu1" class="container tab-pane fade"><br>
                                    <div class="container">
                                        <div class="form-group">
                                            <label for="combobox1">Indicadores disponibles</label>
                                            <select class="form-control" id="combobox1" name="combobox1">
                                                <?php for ($i = 0; $i < count($arregloIndicadores); $i++) { ?>
                                                    <option value="<?php echo $arregloIndicadores[$i]->getIdIndicador() . ";" . $arregloIndicadores[$i]->getNombreIndicador(); ?>">
                                                        <?php echo $arregloIndicadores[$i]->getIdIndicador() . ";" . $arregloIndicadores[$i]->getNombreIndicador(); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <br>
                                            <label for="listbox1">Indicadores seleccionados</label>
                                            <select multiple class="form-control" id="listbox1" name="listbox1[]">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" id="btnAgregarItem" name="bt" class="btn btn-success" onclick="agregarItem('combobox1', 'listbox1')">Agregar Item</button>
                                            <button type="button" id="btnRemoverItem" name="bt" class="btn btn-success" onclick="removerItem('listbox1')">Remover Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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