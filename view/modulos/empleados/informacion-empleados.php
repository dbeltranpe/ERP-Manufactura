<?php
session_set_cookie_params(0);
session_start();

require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ProductoDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InventarioProductoDAO.class.php');

if ($_SESSION["loggedIn"] != true) {
	header("Location:http://localhost/erpbienesyservicios/view/principal/login.php");
}

if (isset($_POST['logout'])) {
	session_unset();
	session_destroy();
	header("Location:http://localhost/erpbienesyservicios/view/principal/login.php");
	exit();
}


$trabajadorDAO = new TrabajadorDAO();
$trabajador = $trabajadorDAO->getTrabajador($_SESSION["loggedIn"]);

$productoDAO = new ProductoDAO();
$invProdDAO = new InventarioProductoDAO();


if (isset($_POST['editarTrabajador'])) {
	$codTra = $_POST['txtCode'];
	$codTraU = $_POST['txtCodeU'];
	$nombreTra = $_POST['txtNom'];
	$mailTra = $_POST['txtMail'];
	$telTra = $_POST['txtTel'];
	$suelTra = $_POST['txtSuel'];

	$trabajadorDAO->updateTrabajadorDos($codTra,$codTraU,$nombreTra,$mailTra,$telTra,$suelTra);
}

if (isset($_POST['eliminarEmpleado'])) {
	$codigoTra = $_POST['codigo'];
	$codigoTraU = $_POST['codigoU'];

	$trabajadorDAO->deleteTrabajador($codigoTra,$codigoTraU);
}

if (isset($_POST['editarImagen'])) {
	$imgCode = $_POST['imgCode'];
	$nomUsuario =  $_POST['nomU'];

	$val = $_FILES['imgT']['name'];
	$src = $_FILES['imgT']['tmp_name'];
	$file = "../../images/users/".$nomUsuario.'_'.$val;
	copy($src, $file);

	$trabajadorDAO->updateImg($imgCode, $file);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="au theme template">
	<meta name="author" content="Hau Nguyen">
	<meta name="keywords" content="au theme template">

	<!-- Title Page-->
	<title>Dashboard</title>

	<!-- Fontfaces CSS-->
	<link href="../../css/font-face.css" rel="stylesheet" media="all">
	<link href="../../vendor/font-awesome-4.7/css/font-awesome.min.css"
	rel="stylesheet" media="all">
	<link href="../../vendor/font-awesome-5/css/fontawesome-all.min.css"
	rel="stylesheet" media="all">
	<link
	href="../../vendor/mdi-font/css/material-design-iconic-font.min.css"
	rel="stylesheet" media="all">

	<!-- Bootstrap CSS-->
	<link href="../../vendor/bootstrap-4.1/bootstrap.min.css"
	rel="stylesheet" media="all">

	<!-- Vendor CSS-->
	<link href="../../vendor/animsition/animsition.min.css" rel="stylesheet"
	media="all">
	<link
	href="../../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
	rel="stylesheet" media="all">
	<link href="../../vendor/wow/animate.css" rel="stylesheet" media="all">
	<link href="../../vendor/css-hamburgers/hamburgers.min.css"
	rel="stylesheet" media="all">
	<link href="../../vendor/slick/slick.css" rel="stylesheet" media="all">
	<link href="../../vendor/select2/select2.min.css" rel="stylesheet"
	media="all">
	<link href="../../vendor/perfect-scrollbar/perfect-scrollbar.css"
	rel="stylesheet" media="all">

	<!-- Main CSS-->
	<link href="../../css/theme.css" rel="stylesheet" media="all">
	<style type="text/css">
		.expandir:hover .imagen {
			-webkit-transform:scale(1.3);transform:scale(1.3);
		}
		.expandir {
			overflow:hidden;
		}
		.threed:hover
		{
			cursor: pointer;
			box-shadow:
			1px 1px #53a7ea,
			2px 2px #53a7ea,
			3px 3px #53a7ea;
			-webkit-transform: translateX(-3px);
			transform: translateX(-3px);
		}
	</style>
</head>
<body class="animsition">
	<div class="page-wrapper">

		<!-- MENU SIDEBAR-->
		<aside class="menu-sidebar d-none d-lg-block">
			<div class="logo">
				<a href="#"> <img src="../../images/icon/logo.png" alt="Cool Admin" />
				</a>
			</div>
			<div class="menu-sidebar__content js-scrollbar1">
				<nav class="navbar-sidebar">
					<ul class="list-unstyled navbar__list">
<?php

    if ($_SESSION["rol"] == 1) {
        echo '<li><a href="../../principal/index.php"> <i';
        echo ' class="fas fa-tachometer-alt"></i>Dashboard</a></li>';
    }

    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2 || $_SESSION["rol"] == 3 || $_SESSION["rol"] == 4) {
        echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
        echo ' class="fas fa-home"></i>Inventario</a>';
        echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
        echo '<li><a href="../inventario/reporte-inventario.php">Reportes</a></li>';

        if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 2) {
            echo '<li><a href="../inventario/insumos-inventario.php">Insumos</a></li>';
            echo '<li><a href="../inventario/productos-inventario.php">Producto Terminado</a></li>';
        }

        echo '</ul></li>';
    }

    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 3 || $_SESSION["rol"] == 4) {
        echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
        echo ' class="fas fa-truck"></i>Producci&oacute;n </a>';
        echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
        echo '<li><a href="../produccion/ordenes-produccion.php">Ordenes de Producci&oacute;n</a></li>';
        echo '<li><a href="../produccion/trazabilidad-produccion.php">Ver Trazabilidad</a></li>';
        echo '</ul></li>';
    }

    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 3 || $_SESSION["rol"] == 4 || $_SESSION["rol"] == 5) {
        echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
        echo ' class="fas fa-credit-card"></i>Ventas</a>';
        echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
        echo '<li><a href="../ventas/facturas.php">Registrar Factura</a></li>';
        echo '<li><a href="../ventas/estado-ventas.php">Visualizaci&oacute;n Facturas</a></li>';
        echo '</ul></li>';
    }

    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 5) {
        echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
        echo ' class="fas fa-dollar"></i>Finanzas</a>';
        echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
        echo '<li><a href="../finanzas/cuentas-finanzas.php">General</a></li>';
        echo '<li><a href="../finanzas/analisis-cuentas.php">Movimientos</a></li>';
        echo ' </ul></li>';
    }

    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 6) {
        echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
        echo ' class="fas fa-shopping-cart"></i>Compras</a>';
        echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
        echo '<li><a href="../compras/nueva-compra.php">Registrar Compra</a></li>';
        echo '<li><a href="../compras/proveedores.php">Proveedores</a></li>';
        echo '<li><a href="../compras/informacion-compras.php">Estado de Compras</a></li>';
        echo ' </ul></li>';
    }

    if ($_SESSION["rol"] == 1 || $_SESSION["rol"] == 7) {
        echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
        echo ' class="fas  fa-group"></i>R.R.H.H.</a>';
        echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
        echo '<li><a href="../empleados/nuevo-empleado.php">Registrar Empleado</a></li>';
        echo '<li><a href="../empleados/informacion-empleados.php">Informaci&oacute;n Empleados</a></li>';
        echo ' </ul></li>';
    }
 ?>
					</ul>
				</nav>
			</div>
		</aside>
		<!-- END MENU SIDEBAR-->

		<!-- PAGE CONTAINER-->
		<div class="page-container">
			<!-- HEADER DESKTOP-->
			<header class="header-desktop">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						<div class="header-wrap">
							<form class="form-header" action="" method="POST">
								<input class="au-input au-input--xl" type="text" name="search"
								placeholder="Search for datas &amp; reports..." />
								<button class="au-btn--submit" type="submit">
									<i class="zmdi zmdi-search"></i>
								</button>
							</form>
							<div class="header-button">


								<!-- Información Cuenta -->

								<div class="account-wrap">
									<div class="account-item clearfix js-item-menu">
										<div class="image">
											<?php

											file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/view/images/icon/avatar.jpg', $trabajador->imagen);

											?>
											<img src="../../images/icon/avatar.jpg" />
										</div>
										<div class="content">
											<a class="js-acc-btn" href="#" id="nombre_cuenta_1">
												<?php
												echo utf8_encode($trabajador->nombre);
												?>
											</a>
										</div>
										<div class="account-dropdown js-dropdown">
											<div class="info clearfix">
												<div class="image">
													<a href="#"> <img src="../../images/icon/avatar.jpg" />
													</a>
												</div>
												<div class="content">
													<h5 class="name">
														<a href="#" id="nombre_cuenta_2">
															<?php
															echo utf8_encode($_SESSION["username"]);
															?>
														</a>
													</h5>
													<span class="email" id="correo_cuenta">
														<?php
														echo utf8_encode($trabajador->correo);
														?>
													</span>
												</div>
											</div>
											<div class="account-dropdown__body">
												<div class="account-dropdown__item">
													<a href="../../principal/cuenta.php"> <i
														class="zmdi zmdi-account"></i>Cuenta
													</a>
												</div>
												<div class="account-dropdown__item">
													<a href="#"> <i class="zmdi zmdi-settings"></i>Configuraciones
													</a>
												</div>

											</div>
											<div class="account-dropdown__footer">
												<form action="" method="post">
													<button class="au-btn au-btn--block au-btn--red m-b-20"
													type="submit" name="logout">Cerrar Sesi&oacute;n</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- HEADER DESKTOP-->

			<!-- MAIN CONTENT-->
			<section class="card" style="margin-top: 100px;">
				<div class="card-header">Agregar Nuevo Trabajador</div>
				<div class="card-body">
					<div>
						<button id="payment-button" type="submit"
						class="btn btn-lg btn-info btn-block" onclick="location='nuevo-empleado.php'">
						<i class="fa fa-check-circle"></i>&nbsp; <span id="payment-button-amount">Agregar</span>
					</button>
				</div>
			</div>
		</section>

		<div class="row" style="width: 100%;height: 100%; margin-top:20px;width: 100%;margin-left: 5px;">
			<div class="col" style="margin-top: 100px;width: 100%;">
				<div class="" style="width: 100%;">
					<div class="text-center btn-info" style="color: white;font-size: 20px;height: 40px;border-top-left-radius: 5px; border-top-right-radius: 5px; margin-top: -80px; padding: 5px;">
						<p>Empleados registrados</p>
					</div>
					<input class="form-control" id="myInput" type="text" placeholder="Buscar" style="margin-bottom: 1px">
				</div>
				<div style="width: 100%;height: 100%; overflow: auto;">
					<table class="table table-bordered table-striped" style="width: 100%;">
						<tbody id="myTable">
							<?php
							$empleados = $trabajadorDAO->listarTrabajadores();
							for ($i = 0; $i < sizeof($empleados); $i ++) 
							{
								?>
								<tr>
									<td>
										<div class="" style="margin-left: 7px;font-size: 20px;margin-right: 10px;width: 98.5%;">
											<div class="">
												<div class="row btn-info">
													<div class="col-6 text-center">
														<p class="card-title text-left" style="color: white;font-size: 18px; margin-top: 8px;">
															<i class="fas fa-info-circle" style="margin-right: 5px;"></i> Información
														</p>
													</div>
												</div>
												<br>
											</div>
											<div class="row">
												<div class="col-2 text-right">
													<div>
														<img class="threed" data-toggle="modal" data-target="<?php echo('#imagen'.$empleados[$i]['codigo_trabajador']); ?>" src="<?php echo($empleados[$i]['img_trabajador']); ?>" style="margin-left: 30px; margin-bottom: 40px; width: 80%;">
													</div>
												</div>
												<div class="col-5 text-left" style="margin-left: 30px; margin-top: -20px;">
													<div class="row" style="margin-top: 15px;">
														<div class="col-5" style="margin-left: 5px; font-size: 18px;">
															<b>Nombre: </b>
														</div>
														<div class="col-6" style="font-size: 18px;">
															<?php echo($empleados[$i]['nombre_trabajador']); ?>
														</div>
													</div>
													<div class="row" style="margin-top: 12px;">
														<div class="col-5" style="margin-left: 5px; font-size: 18px;">
															<b>Rol: </b>
														</div>
														<div class="col-6" style="font-size: 18px;">
															<?php echo($empleados[$i]['username_usuario']); ?>
														</div>
													</div>
													<div class="row" style="margin-top: 12px;">
														<div class="col-5" style="margin-left: 5px; font-size: 18px;">
															<b>Correo: </b>
														</div>
														<div class="col-6" style="font-size: 18px;">
															<?php echo($empleados[$i]['correo_trabajador']); ?>
														</div>
													</div>
													<div class="row" style="margin-top: 12px;">
														<div class="col-5" style="margin-left: 5px; font-size: 18px;">
															<b>Teléfono: </b>
														</div>
														<div class="col-6" style="font-size: 18px;">
															<?php echo($empleados[$i]['tel_trabajador']); ?>
														</div>
													</div>
												</div>
												<div class="col-4 text-left">

													<input class="btn btn-primary" type="button" data-toggle="modal" data-target="<?php echo('#editar'.$empleados[$i]['codigo_trabajador']); ?>" name="btn2" style="background: #2874A6;margin-top: 8px;width: 80%;" value="Editar">
													<form method="POST" action="">
														<input type="text" hidden name="codigo" value="<?php echo($empleados[$i]["codigo_trabajador"]); ?>">
														<input type="text" hidden name="codigoU" value="<?php echo($empleados[$i]["cod_usuario"]); ?>">
														<input class="btn btn-danger" name="eliminarEmpleado" type="submit" style="margin-top: 8px;width: 80%;" value="Eliminar">
													</form>
												</div>
											</div>
										</div>
									</td>
								</tr>
							<?php }
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END MAIN CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<!-- CONTAINER MODALS-->
<?php
$trabajadores = $trabajadorDAO->listarTrabajadores();
for ($i = 0; $i < sizeof($trabajadores); $i ++) { ?>
	<div class="modal fade" id="<?php echo('editar'.$trabajadores[$i]['codigo_trabajador']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 80px;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar Información Del Empleado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="#" enctype="multipart/form-data">
						<input type="hidden" name="txtCode" value="<?php echo($trabajadores[$i]['codigo_trabajador']); ?>">
						<input type="hidden" name="txtCodeU" value="<?php echo($trabajadores[$i]['cod_usuario']); ?>">
						<div class="row">
							<div class="col-1">
								<i class="fa fa-address-card" style="font-size: 28px;color: black;"></i>
							</div>
							<div class="col-10">
								<input required placeholder="nombre" type="text" style="width: 100%;margin-left: 15px; border-radius: 5px;border-bottom: solid;border-color:#5DADE2;" name="txtNom" value="<?php echo($trabajadores[$i]['nombre_trabajador']); ?>">
							</div>
							
						</div>
						<div class="row">
							<div class="col-1">
								<i class="fas fa-at" style="font-size: 28px;color: black;margin-top: 10px;"></i>
							</div>
							<div class="col-10">
								<input required placeholder="correo" type="mail" style="width: 100%;margin-top: 10px;margin-left: 15px; border-radius: 5px;border-bottom: solid;border-color:#5DADE2;"  name="txtMail" value="<?php echo($trabajadores[$i]['correo_trabajador']); ?>">
							</div>
							
						</div>
						<div class="row">
							<div class="col-1">
								<i class="fas fa-phone-volume" style="font-size: 28px;color: black;margin-top: 10px;"></i>
							</div>
							<div class="col-10">
								<input required placeholder="Teléfono" type="text" style="width: 100%;margin-top: 10px;margin-left: 15px; border-radius: 5px;border-bottom: solid;border-color:#5DADE2;"  name="txtTel" value="<?php echo($trabajadores[$i]['tel_trabajador']); ?>">
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-1">
								<i class="fas fa-money-bill-alt" style="font-size: 28px;color: black;margin-top: 10px;"></i>
							</div>
							<div class="col-10">
								<input required placeholder="sueldo" type="number" style="width: 100%;margin-top: 10px;margin-left: 15px; border-radius: 5px;border-bottom: solid;border-color:#5DADE2;"  name="txtSuel" value="<?php echo($trabajadores[$i]['sueldo']); ?>">
							</div>
							
						</div>
						<div class="row">
							<div class="col-1"></div>
							<div class="col-10">
								<input type="submit" name="editarTrabajador" class="btn btn-primary" value="Actualizar Datos" style="width: 100%; margin-top: 20px; color: #FFF;">
							</div>
							<div class="col-1"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="<?php echo('imagen'.$trabajadores[$i]['codigo_trabajador']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 80px;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar Imagen Del Empleado</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="#" enctype="multipart/form-data">
						<input type="hidden" name="imgCode" value="<?php echo($trabajadores[$i]['codigo_trabajador']); ?>">
						<input type="hidden" name="nomU" value="<?php echo($trabajadores[$i]['nombre_trabajador']); ?>">
						<div class="row">
							<div class="col-2"></div>
								<div style="margin-top: 15px;" class="col-8">
									<input type="file" name="imgT" value="<?php echo($trabajadores[$i]['img_trabajador']); ?>" required>
								</div>
							<div class="col-2"></div>
						</div>
						<div class="row">
							<div class="col-1"></div>
							<div class="col-10">
								<input type="submit" name="editarImagen" class="btn btn-primary" value="Actualizar Datos" style="width: 100%; margin-top: 20px; color: #FFF;">
							</div>
							<div class="col-1"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- END MODALS CONTAINER-->
<!-- Jquery JS-->
<script src="../../vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="../../vendor/bootstrap-4.1/popper.min.js"></script>
<script src="../../vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="../../vendor/slick/slick.min.js">
</script>
<script src="../../vendor/wow/wow.min.js"></script>
<script src="../../vendor/animsition/animsition.min.js"></script>
<script
src="../../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="../../vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="../../vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="../../vendor/circle-progress/circle-progress.min.js"></script>
<script src="../../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../vendor/chartjs/Chart.bundle.min.js"></script>
<script src="../../vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="../../js/main.js"></script>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>
</html>
<!-- end document-->
