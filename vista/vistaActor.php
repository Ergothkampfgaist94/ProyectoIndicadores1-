<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlActor.php';
include '../controlador/ControlTipoActor.php';
include '../modelo/Actor.php';
include '../modelo/TipoActor.php';
$boton = "";
$idActor = "";
$nombreActor = "";
$objControlTipoActor = new ControlTipoActor(null);
$arregloTipoActor = $objControlTipoActor->listar();
$objControlActor = new ControlActor(null);
$arregloActor = $objControlActor->listar();
if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtid'])) $idActor = $_POST['txtid'];
if (isset($_POST['txtNombreActor'])) $nombreActor = $_POST['txtNombreActor'];
if (isset($_POST['combobox1'])) $combobox1 = $_POST['combobox1'];
switch ($boton) {
    case 'Guardar':
        $cadena = explode(". ", $combobox1);
        $id = $combobox1[0];
        $objActor = new Actor($idActor, $nombreActor, $id);
        $objControlActor = new ControlActor($objActor);
        $objControlActor->guardar();
        header('Location: vistaActor.php');
        break;
    case 'Consultar':
        $objActor = new Actor($idActor, "", "");
        $objControlActor = new ControlActor($objActor);
        $objControlActor = $objControlActor->consultar();
        $nombreActor = $objActor->getNombreActor();
        break;
    case 'Modificar':
        $objActor = new Actor($idActor, $nombreActor, "");
        $objControlActor = new ControlActor($objActor);
        $objControlActor->modificar();
        header('Location: vistaActor.php');
        break;
    case 'Borrar':
        $objActor = new Actor($idActor, "", "");
        $objControlActor = new ControlActor($objActor);
        $objControlActor->borrar();
        header('Location: vistaActor.php');
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
                            <h2 class="miEstilo">Gestión <b>Actor</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión Actor</span></a>

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
                            <th>Nombre Actor</th>
                            <th>Tipo Actor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arregloActor); $i++) {
                        ?>
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td><?php echo $arregloActor[$i]->getIdActor(); ?></td>
                                <td><?php echo $arregloActor[$i]->getNombreActor(); ?></td>
                                <td><?php echo $arregloActor[$i]->getfkidTipoActor(); ?></td>
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
                        <h4 class="modal-title">Tipo Actor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>id</label>
                            <input type="id" id="txtid" name="txtid" class="form-control" value="<?php echo $idActor ?>">
                        </div>
                        <div class="form-group">
                            <label>Nombre Actor</label>
                            <input type="text" id="txtNombreActor" name="txtNombreActor" class="form-control" value="<?php echo $nombreActor ?>">
                        </div>
                        <div class="container">
                            <div class="form-group">
                                <label for="combobox1">Todos los tipos de actores</label>
                                <select class="form-control" id="combobox1" name="combobox1">
                                    <?php for ($i = 0; $i < count($arregloTipoActor); $i++) { ?>
                                        <option value="<?php echo $arregloTipoActor[$i]->getidTipoActor() . ". " . $arregloTipoActor[$i]->getnombreTipoActor(); ?>">
                                            <?php echo $arregloTipoActor[$i]->getidTipoActor() . ". " . $arregloTipoActor[$i]->getnombreTipoActor(); ?>
                                        </option>
                                    <?php } ?>
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