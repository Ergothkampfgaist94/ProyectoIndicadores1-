<?php
include '../controlador/configBd.php';
include '../controlador/ControlConexion.php';
include '../controlador/ControlUsuario.php';
include '../controlador/ControlRol.php';
include '../controlador/ControlRolUsuario.php';
include '../modelo/Usuario.php';
include '../modelo/Rol.php';
include '../modelo/RolUsuario.php';
$boton = "";
$ema = "";
$con = "";
$listbox1 = array();
$objControlUsuario = new ControlUsuario(null);
$arregloUsuarios = $objControlUsuario->listar();
$objControlRol = new ControlRol(null);
$arregloRoles = $objControlRol->listar();
if (isset($_POST['bt'])) $boton = $_POST['bt'];
if (isset($_POST['txtEmail'])) $ema = $_POST['txtEmail'];
if (isset($_POST['txtContrasena'])) $con = $_POST['txtContrasena'];
if (isset($_POST['listbox1'])) $listbox1 = $_POST['listbox1'];
switch ($boton) {
	case 'Guardar':
		$objUsuario = new Usuario($ema, $con);
		$objControlUsuario = new ControlUsuario($objUsuario);
		$objControlUsuario->guardar();
		if ($listbox1 != "") {
			for ($i = 0; $i < count($listbox1); $i++) {
				$cadenas = explode(";", $listbox1[$i]);
				$id = $cadenas[0];
				$objRolUsuario = new RolUsuario($ema, $id);
				$objControlRolUsuario = new ControlRolUsuario($objRolUsuario);
				$objControlRolUsuario->guardar();
			}
		}
		header('Location: vistaUsuarios.php');
		break;
	case 'Consultar':
		$objUsuario = new Usuario($ema, "");
		$objControlUsuario = new ControlUsuario($objUsuario);
		$objUsuario = $objControlUsuario->consultar();
		$con = $objUsuario->getContrasena();
		//Llenar el listbox1 con la lista de roles del ususario específico.
		$objControlRolUsuario = new ControlRolUsuario(null);
		$arregloRolesConsulta = $objControlRolUsuario->listarRolesDelUsuario($ema);
		//Asignarle los datos de arregloRolesConsulta al listbox1.

		break;
	case 'Modificar':
		$objUsuario = new Usuario($ema, $con);
		$objControlUsuario = new ControlUsuario($objUsuario);
		$objControlUsuario->modificar();
		header('Location: vistaUsuarios.php');
		break;
	case 'Borrar':
		$objUsuario = new Usuario($ema, "");
		$objControlUsuario = new ControlUsuario($objUsuario);
		$objControlUsuario->borrar();
		header('Location: vistaUsuarios.php');
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
							<th>Email</th>
							<th>Contraseña</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						for ($i = 0; $i < count($arregloUsuarios); $i++) {
						?>
							<tr>
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" id="checkbox1" name="options[]" value="1">
										<label for="checkbox1"></label>
									</span>
								</td>
								<td><?php echo $arregloUsuarios[$i]->getEmail(); ?></td>
								<td><?php echo $arregloUsuarios[$i]->getContrasena(); ?></td>
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
				<form action="vistaUsuarios.php" method="post">
					<div class="modal-header">
						<h4 class="modal-title">Usuario</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">

						<div class="container">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#home">Datos de usuario</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#menu1">Roles por usuario</a>
								</li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div id="home" class="container tab-pane active"><br>
									<div class="form-group">
										<label>Email</label>
										<input type="email" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $ema ?>">
									</div>
									<div class="form-group">
										<label>Contraseña</label>
										<input type="text" id="txtContrasena" name="txtContrasena" class="form-control" value="<?php echo $con ?>">
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
											<label for="combobox1">Todos los roles</label>
											<select class="form-control" id="combobox1" name="combobox1">
												<?php for ($i = 0; $i < count($arregloRoles); $i++) { ?>
													<option value="<?php echo $arregloRoles[$i]->getId() . ";" . $arregloRoles[$i]->getNombre(); ?>">
														<?php echo $arregloRoles[$i]->getId() . ";" . $arregloRoles[$i]->getNombre(); ?>
													</option>
												<?php } ?>
											</select>
											<br>
											<label for="listbox1">Roles específicos del usuario</label>
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