<?php
session_set_cookie_params(0);
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InsumoDAO.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InventarioInsumoDAO.class.php');

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

$insumoDAO = new InsumoDAO();
$invInsDAO = new InventarioInsumoDAO();

if (isset($_POST['agregarInsumo'])) {
    $codIns= $_POST['ins_1'];
    $cantidadIns= $_POST['cant_1'];
    
    $invInsDAO->save($codIns, $cantidadIns);
}

if (isset($_POST['eliminarInsumo'])) {
    $codIns= $_POST['ins_2'];
    
    $invInsDAO->deleteInventarioInsumo($codIns);
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
        echo '<li><a href="../finanzas/general-finanzas.php">General</a></li>';
        echo '<li><a href="../finanzas/movimientos-finanzas.php">Movimientos</a></li>';
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
<!-- 								<input class="au-input au-input--xl" type="text" name="search" -->
<!-- 									placeholder="LA CORONA LA LLEVAS T&Uacute;" disabled/> -->
<!-- 								<button class="au-btn--submit" type="submit"> -->
<!-- 									<i class="zmdi zmdi-search"></i> -->
<!-- 								</button> -->
							</form>
							<div class="header-button">


								<!-- Información Cuenta -->

								<div class="account-wrap">
									<div class="account-item clearfix js-item-menu">
										<div class="image">
										   
											<img src="<?php  echo($trabajador->getImagen()); ?>" />
										</div>
										<div class="content">
											<a class="js-acc-btn" href="#" id="nombre_cuenta_1">
											<?php echo utf8_encode($trabajador->nombre); ?>
											</a>
										</div>
										<div class="account-dropdown js-dropdown">
											<div class="info clearfix">
												<div class="image">
													<a href="#"> <img src="<?php  echo($trabajador->getImagen()); ?>" />
													</a>
												</div>
												<div class="content">
													<h5 class="name">
														<a href="#" id="nombre_cuenta_2">
														<?php echo utf8_encode($_SESSION["username"]); ?>
														</a>
													</h5>
													<span class="email" id="correo_cuenta">
													<?php echo utf8_encode($trabajador->correo); ?>
													</span>
												</div>
											</div>
											<div class="account-dropdown__body">
												<div class="account-dropdown__item">
													<a href="../../principal/cuenta.php"> <i
														class="zmdi zmdi-account"></i>Cuenta
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
			<div class="main-content">
				<div class="container-fluid">


					<div class="row">

						<div class="col">
							<section class="card">
								<div class="card-header">Agregar o Quitar Insumos al Inventario</div>
								<div class="card-body">
									<div class="card-title">
										<h3 class="text-center title-2">Informaci&oacute;n para el
											Inventario</h3>
									</div>
									<hr>
									<form action="#" method="post" novalidate="novalidate">

										<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">Insumo</label>

											<select id='ins_1' name="ins_1" class=" form-control">
                                                <?php

                                                $insumos = $insumoDAO->listarInsumos();

                                                for ($i = 0; $i < sizeof($insumos); $i ++) {
                                                    echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                                }

                                                ?>
											</select>

										</div>

										<div class="form-group">
											<label for="cant_1" class="control-label mb-1">Cantidad</label>
											<input id="cant_1" name="cant_1" type="number"
												class="form-control" aria-required="true"
												aria-invalid="false">
										</div>


										<div>
											<button id="agregarInsumo" name="agregarInsumo" type="submit"
												class="btn btn-lg btn-info btn-block">
												<i class="fa fa-check-circle"></i>&nbsp; <span
													id="payment-button-amount">Enviar</span>
											</button>
										</div>
									</form>
								</div>
							</section>
						</div>

						<div class="col">
							<section class="card">
								<div class="card-header">Eliminar Insumos del Inventario</div>
								<div class="card-body">
									<div class="card-title">
										<h3 class="text-center title-2">Informaci&oacute;n para el
											Inventario</h3>
									</div>
									<hr>
									<form action="#" method="post" novalidate="novalidate">

										<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">Insumo</label>

											<select id='ins_2' name="ins_2" class=" form-control">
                                                <?php

                                                $insumos = $insumoDAO->listarInsumos();

                                                for ($i = 0; $i < sizeof($insumos); $i ++) {
                                                    echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                                }

                                                ?>
											</select>

										</div>

										<div>
											<button id="eliminarInsumo" name="eliminarInsumo" type="submit"
												class="btn btn-danger btn-lg btn-block">
												<i class="fa fa-times-circle"></i>&nbsp; <span
													id="payment-button-amount">Eliminar</span>
											</button>
										</div>
									</form>
								</div>
							</section>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="table-responsive table--no-card m-b-30">
								<table
									class="table table-borderless table-striped table-earning">
								
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Cantidad</th>
											<th>Insumo</th>
											<th class="text-right">Valor Unitario</th>
											<th class="text-right">I.V.A.</th>
											<th class="text-right">Total</th>
										</tr>
									</thead>
									<tbody>
									
									   <?php

                                                $insumos = $invInsDAO->listarInventarioInsumos();

                                                for ($i = 0; $i < sizeof($insumos); $i ++) 
                                                {
                                                    echo "<tr>";
                                                    echo "<td> " . $insumos[$i]['fecha'] . "</td>";
                                                    echo "<td> " . $insumos[$i]['cantidad'] . "</td>";
                                                    echo "<td> " . $insumos[$i]['nom_insumo'] . "</td>";
                                                    echo "<td class='text-right'> " . $insumos[$i]['valor_insumo'] . "</td>";
                                                    echo "<td class='text-right'> " . $insumos[$i]['iva_insumo'] . "</td>";
                                                    echo "<td class='text-right'> " . $insumos[$i]['total'] . "</td>";
                                                    echo "</tr>";
                                                }

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

</html>
<!-- end document-->
