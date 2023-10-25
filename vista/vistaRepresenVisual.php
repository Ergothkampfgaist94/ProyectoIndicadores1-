<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlRepresenVisual.php';
include '../modelo/RepresenVisual.php';
$boton = "";
$idRepresenVisual = "";
$nombreRepresenVisual = "";
$objControlRepresenVisual = new ControlRepresenVisual(null);
$arregloRepresenVisual = $objControlRepresenVisual->listar();
if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtid'])) $idRepresenVisual = $_POST['txtid'];
if (isset($_POST['txtNombreRepresenVisual'])) $nombreRepresenVisual = $_POST['txtNombreRepresenVisual'];
switch ($boton) {
	case 'Guardar':
		$objRepresenVisual = new RepresenVisual($idRepresenVisual, $nombreRepresenVisual);
		$objControlRepresenVisual = new ControlRepresenVisual($objRepresenVisual);
		$objControlRepresenVisual->guardar();
		header('Location: vistaRepresenVisual.php');
		break;
	case 'Consultar':
		$objRepresenVisual = new RepresenVisual($idRepresenVisual, "");
		$objControlRepresenVisual = new ControlRepresenVisual($objRepresenVisual);
		$objRepresenVisual = $objControlRepresenVisual->consultar();
		$nombreRepresenVisual = $objRepresenVisual->getNombreRepresenVisual();
		break;
	case 'Modificar':
		$objRepresenVisual = new RepresenVisual($idRepresenVisual, $nombreRepresenVisual);
		$objControlRepresenVisual = new ControlRepresenVisual($objRepresenVisual);
		$objControlRepresenVisual->modificar();
		header('Location: vistaRepresenVisual.php');
		break;
	case 'Borrar':
		$objRepresenVisual = new RepresenVisual($idRepresenVisual, "");
		$objControlRepresenVisual = new ControlRepresenVisual($objRepresenVisual);
		$objControlRepresenVisual->borrar();
		header('Location: vistaRepresenVisual.php');
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
	<title>Representación Visual</title>
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
							<h2 class="miEstilo">Gestión <b>Representación Visual</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#crudModal" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE84E;</i> <span>Gestión RepresenVisuals</span></a>

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
							<th>Nombre</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < count($arregloRepresenVisual); $i++) {
						?>
							<tr>
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" id="checkbox1" name="options[]" value="1">
										<label for="checkbox1"></label>
									</span>
								</td>
								<td><?php echo $arregloRepresenVisual[$i]->getIdRepresenVisual(); ?></td>
								<td><?php echo $arregloRepresenVisual[$i]->getNombreRepresenVisual(); ?></td>
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
				<form action="vistaRepresenVisual.php" method="post">
					<div class="modal-header">
						<h4 class="modal-title">Representación Visual</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>id</label>
							<input type="id" id="txtid" name="txtid" class="form-control" value="<?php echo $idRepresenVisual ?>">
						</div>
						<div class="form-group">
							<label>Representación Visual</label>
							<input type="nombreRepresenVisual" id="txtNombreRepresenVisual" name="txtNombreRepresenVisual" class="form-control" value="<?php echo $nombreRepresenVisual ?>">
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