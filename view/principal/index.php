<?php
session_set_cookie_params(0);
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/FacturaDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ItemFacturaDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/CompraDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/OrdenProduccionDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/HistoricoDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/FinanzasDAO.class.php');

$meses = array(
    "",
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
);

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

$trabajador->nombre;

$finanzas = new FinanzasDAO();

$historicoDAO = new HistoricoDAO();
$historia = $historicoDAO->listarHistoria();

$hs_fechas = array();
$hs_ventas = array();
$hs_compras = array();
$hs_insumos = array();
$hs_productos = array();
$hs_rrhh = array();
$hs_ordenes = array();

for ($i = 0; $i < sizeof($historia); $i ++) {
    $fecha = date_create($historia[$i]['fecha']);
    $numero = (int) date_format($fecha, 'm');
    $mes = $meses[$numero];

    $hs_fechas[] = $mes;
    $hs_ventas[] = $historia[$i]['vl_ventas'];
    $hs_compras[] = $historia[$i]['vl_compras'];
    $hs_insumos[] = $historia[$i]['nro_insumos'];
    $hs_productos[] = $historia[$i]['nro_productos'];
    $hs_rrhh[] = $historia[$i]['nro_empleados'];
    $hs_ordenes[] = $historia[$i]['nro_ordenes'];
}

echo '<script>var hs_fechas = ' . json_encode($hs_fechas) . ';</script>';
echo '<script>var hs_ventas = ' . json_encode($hs_ventas) . ';</script>';
echo '<script>var hs_compras = ' . json_encode($hs_compras) . ';</script>';
echo '<script>var hs_insumos = ' . json_encode($hs_insumos) . ';</script>';
echo '<script>var hs_productos = ' . json_encode($hs_productos) . ';</script>';
echo '<script>var hs_rrhh = ' . json_encode($hs_rrhh) . ';</script>';
echo '<script>var hs_ordenes = ' . json_encode($hs_ordenes) . ';</script>'?>


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
<link href="../css/font-face.css" rel="stylesheet" media="all">
<link href="../vendor/font-awesome-4.7/css/font-awesome.min.css"
	rel="stylesheet" media="all">
<link href="../vendor/font-awesome-5/css/fontawesome-all.min.css"
	rel="stylesheet" media="all">
<link href="../vendor/mdi-font/css/material-design-iconic-font.min.css"
	rel="stylesheet" media="all">

<!-- Bootstrap CSS-->
<link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet"
	media="all">

<!-- Vendor CSS-->
<link href="../vendor/animsition/animsition.min.css" rel="stylesheet"
	media="all">
<link
	href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
	rel="stylesheet" media="all">
<link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
<link href="../vendor/css-hamburgers/hamburgers.min.css"
	rel="stylesheet" media="all">
<link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
<link href="../vendor/select2/select2.min.css" rel="stylesheet"
	media="all">
<link href="../vendor/perfect-scrollbar/perfect-scrollbar.css"
	rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="../css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
	<div class="page-wrapper">
		<!-- MENU SIDEBAR-->
		<aside class="menu-sidebar d-none d-lg-block">
			<div class="logo">
				<a href="#"> <img src="../images/icon/logo.png" alt="Cool Admin" />
				</a>
			</div>
			<div class="menu-sidebar__content js-scrollbar1">
				<nav class="navbar-sidebar">
					<ul class="list-unstyled navbar__list">
						<li><a href="index.php"> <i class="fas fa-tachometer-alt"></i>Dashboard
						</a></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-home"></i>Inventario
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/inventario/reporte-inventario.php">Reportes</a>
								</li>
								<li><a href="../modulos/inventario/insumos-inventario.php">Insumos</a></li>
								<li><a href="../modulos/inventario/productos-inventario.php">Producto
										Terminado</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-truck"></i>Producci&oacute;n
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/produccion/ordenes-produccion.php">Ordenes
										de Producci&oacute;n</a></li>
								<li><a href="../modulos/produccion/trazabilidad-produccion.php">Ver
										trazabilidad</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-credit-card"></i>Ventas
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/ventas/facturas.php">Registrar Factura</a></li>
								<li><a href="../modulos/ventas/estado-ventas.php">Visualizaci%oacute;n
										Facturas</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-dollar"></i>Finanzas
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/finanzas/general-finanzas.php">General</a></li>
								<li><a href="../modulos/finanzas/movimientos-finanzas.php">Movimientos</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-shopping-cart"></i>Compras
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/compras/nueva-compra.php">Registrar
										Compra</a></li>
								<li><a href="../modulos/compras/proveedores.php">Proveedores</a></li>
								<li><a href="../modulos/compras/informacion-compras.php">Estado
										de Compras</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas  fa-group"></i>R.R.H.H.
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/empleados/nuevo-empleado.php">Registrar
										Empleado</a></li>
								<li><a href="../modulos/empleados/informacion-empleados.php">Informaci&oacute;n
										Empleados</a></li>
							</ul></li>
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
								<!-- 									placeholder="Search for datas &amp; reports..." /> -->
								<!-- 								<button class="au-btn--submit" type="submit"> -->
								<!-- 									<i class="zmdi zmdi-search"></i> -->
								<!-- 								</button> -->
							</form>
							<div class="header-button">


								<!-- Información Cuenta -->

								<div class="account-wrap">
									<div class="account-item clearfix js-item-menu">

										<div class="content">
											<a class="js-acc-btn" href="#" id="nombre_cuenta_1">
											<?php
        echo utf8_encode($trabajador->nombre);
        ?>
											</a>
										</div>
										<div class="account-dropdown js-dropdown">
											<div class="info clearfix">

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
													<a href="cuenta.php"> <i class="zmdi zmdi-account"></i>Cuenta
													</a>
												</div>
												<!-- 												<div class="account-dropdown__item"> -->
												<!-- 													<a href="#"> <i class="zmdi zmdi-settings"></i>Configuraciones -->
												<!-- 													</a> -->
												<!-- 												</div> -->

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
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="overview-wrap">
									<h2 class="title-1">Visi&oacute;n General</h2>

								</div>
							</div>
						</div>

						<!-- KPI Ventas, Compras, Producción, RRHH -->
						<div class="row m-t-25">

							<!-- Gráfica de Número de Empleados -->
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c1">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-account-o"></i>
											</div>
											<div class="text">
												<h2><?php
            echo $trabajadorDAO->totalTrabajadores();
            ?></h2>
												<span>Empleados</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart1"></canvas>
										</div>
									</div>
								</div>
							</div>

							<!-- Gráfica de Compras -->
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c2">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-shopping-cart"></i>
											</div>
											<div class="text">
												<h2>$<?php
            $compraDAO = new CompraDAO();
            echo number_format($compraDAO->totalCompras());
            ?></h2>
												<span>Valor en Compras</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart2"></canvas>
										</div>
									</div>
								</div>
							</div>

							<!-- Gráfica de Ordenes de Producción  -->
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c3">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-calendar-note"></i>
											</div>
											<div class="text">
												<h2><?php
            $ordenDAO = new OrdenProduccionDAO();
            echo $ordenDAO->totalOrdenes();
            ?></h2>
												<span>Ordenes de Producci&oacute;n</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart3"></canvas>
										</div>
									</div>
								</div>
							</div>

							<!-- Gráfica de Ventas -->
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c4">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-money"></i>
											</div>
											<div class="text">
												<h2>$<?php
            $facturaDAO = new FacturaDAO();
            echo number_format($facturaDAO->totalVentas());
            ?></h2>
												<span>Valor en Ventas</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart4"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>


						<!-- KPI Finanzas, Inventario-->
						<div class="row">

							<!-- Gráfica de Inventario-->
							<div class="col-lg-5" style="height: 100%">
								<div class="au-card recent-report">
									<div class="au-card-inner">
										<h3 class="title-2">Hist&oacute;rico Inventario</h3>

										<div class="chart-info">

											<div class="chart-info__left">
												<div class="chart-note">
													<span class="dot dot--blue"></span> <span>Productos</span>
												</div>
												<div class="chart-note mr-0">
													<span class="dot dot--green"></span> <span>Insumos</span>
												</div>
											</div>

										</div>

										<div class="recent-report__chart">
											<canvas id="recent-rep-chart"></canvas>
										</div>
									</div>
								</div>
							</div>

							<!-- Gráfica de Finanzas-->

							<div class="col-lg-7" style="height: 100%">
								<div class="au-card chart-percent-card">
									<div class="au-card-inner">
										<h3 class="title-1 m-b-25">Ganancias por Productos</h3>
										<div class="table-responsive table--no-card m-b-40">
											<table
												class="table table-borderless table-striped table-earning">
												<thead>
													<tr>
														<th>Nombre del Producto</th>
														<th class="text-right">Precio</th>
														<th class="text-right">Cantidad</th>
														<th class="text-right">Total</th>
													</tr>
												</thead>
												<tbody>
										
                        					 <?php

                            $itemFacturaDAO = new ItemFacturaDAO();

                            $items = $itemFacturaDAO->listarGananciaXProductos();

                            for ($i = 0; $i < sizeof($items); $i ++) {
                                echo "<tr>";
                                echo "<td class='text-left'> " . $items[$i]['nombre'] . "</td>";
                                echo "<td align='text-left'> $" . $items[$i]['precio'] . "</td>";
                                echo "<td align='text-left'> " . $items[$i]['cantidad'] . "</td>";
                                echo "<td class='text-right'> $" . $items[$i]['total'] . "</td>";
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

						<!-- Indicadores de Ventas -->
						<div class="row">
							<div class="col-3">
								<div class="au-card chart-percent-card" id="cd1"
									style="height: 170px;">
									<div class="au-card-inner">
										<h3 class="title-2 tm-b-5">Total Activos</h3>
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-plus" onclick="abrir(1);"
													style="position: absolute; font-size: 20px; margin-top: -100%; cursor: pointer;"></i>
											</div>
										</div>
										<div class="row no-gutters">
											<div class="col-12">
												<div class="chart-note-wrap">
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--1"></span> <span>Cuentas por cobrar</span>
													</div>
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--2"></span> <span>Total compras</span>
													</div>
												</div>
											</div>
											<div class="col-12">
												<div class="percent-chart">
													<canvas id="percent-char"></canvas>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-minus" onclick="cerrar(1);"
													style="position: absolute; font-size: 20px; margin-top: -60%; cursor: pointer;"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-3">
								<div class="au-card chart-percent-card" id="cd2"
									style="height: 200px;">
									<div class="au-card-inner">
										<h3 class="title-2 tm-b-5">Total Pasivos</h3>
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-plus" onclick="abrir(2);"
													style="position: absolute; font-size: 20px; margin-top: -100%; cursor: pointer;"></i>
											</div>
										</div>
										<div class="row no-gutters">
											<div class="col-12">
												<div class="chart-note-wrap">
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--3"></span> <span>Cuentas por pagar</span>
													</div>
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--4"></span> <span>Total compras</span>
													</div>
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--5"></span> <span>N&oacute;mina
															empleados</span>
													</div>
												</div>
											</div>
											<div class="col-12">
												<div class="percent-chart">
													<canvas id="percent-char_2"></canvas>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-minus" onclick="cerrar(2);"
													style="position: absolute; font-size: 20px; margin-top: -60%; cursor: pointer;"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-3">
								<div class="au-card chart-percent-card" id="cd3"
									style="height: 170px;">
									<div class="au-card-inner">
										<h3 class="title-2 tm-b-5">Total Patrimonio</h3>
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-plus" onclick="abrir(3);"
													style="position: absolute; font-size: 20px; margin-top: -100%; cursor: pointer;"></i>
											</div>
										</div>
										<div class="row no-gutters">
											<div class="col-12">
												<div class="chart-note-wrap">
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--6"></span> <span>Inventario insumos</span>
													</div>
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--7"></span> <span>Inventario producto</span>
													</div>
												</div>
											</div>
											<div class="col-12">
												<div class="percent-chart">
													<canvas id="percent-char_3"></canvas>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-minus" onclick="cerrar(3);"
													style="position: absolute; font-size: 20px; margin-top: -60%; cursor: pointer;"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3">
							<div class="au-card chart-percent-card" id="cd4"
									style="height: 170px;">
									<div class="au-card-inner">
										<div class="row">
											<div class="col-10"></div>
											<div class="col-2">
												<i class="fas fa-plus" onclick="abrir(4);"
													style="position: absolute; font-size: 20px; margin-top: -60%; cursor: pointer;"></i>
											</div>
										</div>

								<h2 class="title-1 m-b-25">Compras por Proveedor</h2>
							
								<div
									class="au-card au-card--bg-blue au-card-top-countries m-b-40">
									<div class="au-card-inner">
										<div class="table-responsive">
											<table class="table table-top-countries">
												<tbody>
												
												<?php

            $prov = $compraDAO->totalComprasXProveedor();

            for ($i = 0; $i < sizeof($items); $i ++) {
                ?>
                                                        <tr>
														<td class='text-left'>  <?php echo($prov[$i]['proveedor']); ?> </td>
														<td align='center'> $ <?php echo($prov[$i]['total']);  ?></td>
													</tr>
                                                    <?php
            }

            ?>
												
												</tbody>
											</table>
										</div>
									</div>
								</div>
								</div></div>
							</div>
						</div>

						<!-- Indicadores de Finanzas -->


						<!-- 					g -->
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="copyright">
								<p>
									Copyright Â© 2018 Colorlib. All rights reserved. Template by <a
										href="https://colorlib.com">Colorlib</a>.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="padding: 30px;">
		
			<?php
$activos = $finanzas->activos();
$pasivos = $finanzas->pasivos();
$patrimonio = $finanzas->patrimonio();

echo '<script>var activos = ' . json_encode($activos) . ';</script>';
echo '<script>var pasivos = ' . json_encode($pasivos) . ';</script>';
echo '<script>var patrimonio = ' . json_encode($patrimonio) . ';</script>';
?>
			<!-- END MAIN CONTENT-->
			<!-- END PAGE CONTAINER-->
		</div>

	</div>

	<!-- Jquery JS-->
	<script src="../vendor/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap JS-->
	<script src="../vendor/bootstrap-4.1/popper.min.js"></script>
	<script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
	<!-- Vendor JS       -->
	<script src="../vendor/slick/slick.min.js">
    </script>
	<script src="../vendor/wow/wow.min.js"></script>
	<script src="../vendor/animsition/animsition.min.js"></script>
	<script
		src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
	<script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
	<script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
	<script src="../vendor/circle-progress/circle-progress.min.js"></script>
	<script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="../vendor/chartjs/Chart.bundle.min.js"></script>
	<script src="../vendor/select2/select2.min.js">
    </script>

	<!-- Main JS-->
	<script src="../js/main.js"></script>
	<script type="text/javascript">
	function abrir(num){
		if (num == 2) {
			var x = document.getElementById("cd"+num);
			x.style.height="480px";
		} else {
			var x = document.getElementById("cd"+num);
			x.style.height="450px";
		}
	}
	function cerrar(num){
		if (num == 2) {
			var x = document.getElementById("cd"+num);
			x.style.height="190px";
		} else {
			var x = document.getElementById("cd"+num);
			x.style.height="170px";
		}
	}
	</script>

</body>

</html>
<!-- end document-->
