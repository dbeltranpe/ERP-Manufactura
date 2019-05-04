<?php
session_set_cookie_params(0);
session_start();

require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');

if ($_SESSION["loggedIn"] != true) {
    header("Location:http://localhost/erpbienesyservicios/view/principal/login.php");
}

if (isset($_POST['logout']))
{
session_unset();
session_destroy();
header("Location:http://localhost/erpbienesyservicios/view/principal/login.php");
exit();
    
}

$trabajadorDAO = new TrabajadorDAO();
$trabajador = $trabajadorDAO->getTrabajador($_SESSION["loggedIn"]);

$trabajador->nombre;

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
								<li><a href="../modulos/inventario/productos-inventario.php">Producto Terminado</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-truck"></i>Producci&oacute;n
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/produccion/ordenes-produccion.php">Ordenes de Producci&oacute;n</a></li>
								<li><a href="../modulos/produccion/trazabilidad-produccion.php">Ver trazabilidad</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-credit-card"></i>Ventas
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/ventas/facturas.php">Facturas</a></li>
								<li><a href="../modulos/ventas/estado-ventas.php">Estado de Ventas</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-dollar"></i>Finanzas
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/finanzas/cuentas-finanzas.php">Cuentas</a></li>
								<li><a href="../modulos/finanzas/analisis-cuentas.php">An&aacute;lisis Cuentas</a></li>
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
								<input class="au-input au-input--xl" type="text" name="search"
									placeholder="Search for datas &amp; reports..." />
								<button class="au-btn--submit" type="submit">
									<i class="zmdi zmdi-search"></i>
								</button>
							</form>
							<div class="header-button">
								

								<!-- Informaci�n Cuenta -->
								
								<div class="account-wrap">
									<div class="account-item clearfix js-item-menu">
										<div class="image">
										   <?php
										   
										   file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/view/images/icon/avatar.jpg', $trabajador->imagen);
										   
										   ?>
											<img src="../images/icon/avatar.jpg" />
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
													<a href="#"> <img src="../images/icon/avatar.jpg"/>
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
													<a href="cuenta.php"> <i class="zmdi zmdi-account"></i>Cuenta
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
			<div class="main-content">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="overview-wrap">
									<h2 class="title-1">overview</h2>
									
								</div>
							</div>
						</div>
						<div class="row m-t-25">
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c1">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-account-o"></i>
											</div>
											<div class="text">
												<h2>10368</h2>
												<span>members online</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart1"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c2">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-shopping-cart"></i>
											</div>
											<div class="text">
												<h2>388,688</h2>
												<span>items solid</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart2"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c3">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-calendar-note"></i>
											</div>
											<div class="text">
												<h2>1,086</h2>
												<span>this week</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart3"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="overview-item overview-item--c4">
									<div class="overview__inner">
										<div class="overview-box clearfix">
											<div class="icon">
												<i class="zmdi zmdi-money"></i>
											</div>
											<div class="text">
												<h2>$1,060,386</h2>
												<span>total earnings</span>
											</div>
										</div>
										<div class="overview-chart">
											<canvas id="widgetChart4"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="au-card recent-report">
									<div class="au-card-inner">
										<h3 class="title-2">recent reports</h3>
										<div class="chart-info">
											<div class="chart-info__left">
												<div class="chart-note">
													<span class="dot dot--blue"></span> <span>products</span>
												</div>
												<div class="chart-note mr-0">
													<span class="dot dot--green"></span> <span>services</span>
												</div>
											</div>
											<div class="chart-info__right">
												<div class="chart-statis">
													<span class="index incre"> <i
														class="zmdi zmdi-long-arrow-up"></i>25%
													</span> <span class="label">products</span>
												</div>
												<div class="chart-statis mr-0">
													<span class="index decre"> <i
														class="zmdi zmdi-long-arrow-down"></i>10%
													</span> <span class="label">services</span>
												</div>
											</div>
										</div>
										<div class="recent-report__chart">
											<canvas id="recent-rep-chart"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="au-card chart-percent-card">
									<div class="au-card-inner">
										<h3 class="title-2 tm-b-5">char by %</h3>
										<div class="row no-gutters">
											<div class="col-xl-6">
												<div class="chart-note-wrap">
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--blue"></span> <span>products</span>
													</div>
													<div class="chart-note mr-0 d-block">
														<span class="dot dot--red"></span> <span>services</span>
													</div>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="percent-chart">
													<canvas id="percent-chart"></canvas>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-9">
								<h2 class="title-1 m-b-25">Earnings By Items</h2>
								<div class="table-responsive table--no-card m-b-40">
									<table
										class="table table-borderless table-striped table-earning">
										<thead>
											<tr>
												<th>date</th>
												<th>order ID</th>
												<th>name</th>
												<th class="text-right">price</th>
												<th class="text-right">quantity</th>
												<th class="text-right">total</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>2018-09-29 05:57</td>
												<td>100398</td>
												<td>iPhone X 64Gb Grey</td>
												<td class="text-right">$999.00</td>
												<td class="text-right">1</td>
												<td class="text-right">$999.00</td>
											</tr>
											<tr>
												<td>2018-09-28 01:22</td>
												<td>100397</td>
												<td>Samsung S8 Black</td>
												<td class="text-right">$756.00</td>
												<td class="text-right">1</td>
												<td class="text-right">$756.00</td>
											</tr>
											<tr>
												<td>2018-09-27 02:12</td>
												<td>100396</td>
												<td>Game Console Controller</td>
												<td class="text-right">$22.00</td>
												<td class="text-right">2</td>
												<td class="text-right">$44.00</td>
											</tr>
											<tr>
												<td>2018-09-26 23:06</td>
												<td>100395</td>
												<td>iPhone X 256Gb Black</td>
												<td class="text-right">$1199.00</td>
												<td class="text-right">1</td>
												<td class="text-right">$1199.00</td>
											</tr>
											<tr>
												<td>2018-09-25 19:03</td>
												<td>100393</td>
												<td>USB 3.0 Cable</td>
												<td class="text-right">$10.00</td>
												<td class="text-right">3</td>
												<td class="text-right">$30.00</td>
											</tr>
											<tr>
												<td>2018-09-29 05:57</td>
												<td>100392</td>
												<td>Smartwatch 4.0 LTE Wifi</td>
												<td class="text-right">$199.00</td>
												<td class="text-right">6</td>
												<td class="text-right">$1494.00</td>
											</tr>
											<tr>
												<td>2018-09-24 19:10</td>
												<td>100391</td>
												<td>Camera C430W 4k</td>
												<td class="text-right">$699.00</td>
												<td class="text-right">1</td>
												<td class="text-right">$699.00</td>
											</tr>
											<tr>
												<td>2018-09-22 00:43</td>
												<td>100393</td>
												<td>USB 3.0 Cable</td>
												<td class="text-right">$10.00</td>
												<td class="text-right">3</td>
												<td class="text-right">$30.00</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-lg-3">
								<h2 class="title-1 m-b-25">Top countries</h2>
								<div
									class="au-card au-card--bg-blue au-card-top-countries m-b-40">
									<div class="au-card-inner">
										<div class="table-responsive">
											<table class="table table-top-countries">
												<tbody>
													<tr>
														<td>United States</td>
														<td class="text-right">$119,366.96</td>
													</tr>
													<tr>
														<td>Australia</td>
														<td class="text-right">$70,261.65</td>
													</tr>
													<tr>
														<td>United Kingdom</td>
														<td class="text-right">$46,399.22</td>
													</tr>
													<tr>
														<td>Turkey</td>
														<td class="text-right">$35,364.90</td>
													</tr>
													<tr>
														<td>Germany</td>
														<td class="text-right">$20,366.96</td>
													</tr>
													<tr>
														<td>France</td>
														<td class="text-right">$10,366.96</td>
													</tr>
													<tr>
														<td>Australia</td>
														<td class="text-right">$5,366.96</td>
													</tr>
													<tr>
														<td>Italy</td>
														<td class="text-right">$1639.32</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="copyright">
									<p>
										Copyright © 2018 Colorlib. All rights reserved. Template by <a
											href="https://colorlib.com">Colorlib</a>.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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

</body>

</html>
<!-- end document-->
