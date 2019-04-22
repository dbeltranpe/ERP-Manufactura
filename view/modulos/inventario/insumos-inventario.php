<?php
session_set_cookie_params(0);
session_start();

require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');

if ($_SESSION["loggedIn"] != true) {
    header("Location:http://localhost/erpbienesyservicios/view/principal/login.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location:http://localhost/erpbienesyservicios/view/principal/login.php");
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
						<li><a href="../../principal/index.php"> <i
								class="fas fa-tachometer-alt"></i>Dashboard
						</a></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-home"></i>Inventario
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="reporte-inventario.php">Reportes</a></li>
								<li><a href="#">Insumos</a></li>
								<li><a href="productos-inventario.php">Producto Terminado</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-truck"></i>Producci&oacute;n
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="">A</a></li>
								<li><a href="">B</a></li>
								<li><a href="">C</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-credit-card"></i>Ventas
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="">A</a></li>
								<li><a href="">B</a></li>
								<li><a href="">C</a></li>
							</ul></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-dollar"></i>Finanzas
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="">A</a></li>
								<li><a href="">B</a></li>
								<li><a href="">C</a></li>
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
			<div class="main-content">
				<div class="container-fluid">


					<div class="row">

						<div class="col">
							<section class="card">
								<div class="card-header">Agregar Insumos al Inventario</div>
								<div class="card-body">
									<div class="card-title">
										<h3 class="text-center title-2">Informaci&oacute;n para el
											Inventario</h3>
									</div>
									<hr>
									<form action="" method="post" novalidate="novalidate">

										<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">Producto</label>
											<input id="cc-pament" name="cc-payment" type="text"
												class="form-control" aria-required="true"
												aria-invalid="false">
										</div>

										<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">Cantidad</label>
											<input id="cc-pament" name="cc-payment" type="text"
												class="form-control" aria-required="true"
												aria-invalid="false">
										</div>


										<div>
											<button id="payment-button" type="submit"
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
									<form action="" method="post" novalidate="novalidate">

										<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">Producto</label>
											<input id="cc-pament" name="cc-payment" type="text"
												class="form-control" aria-required="true"
												aria-invalid="false">
										</div>

										<div>
											<button id="payment-button" type="submit"
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
											<th>Producto</th>
											<th class="text-right">Valor Unitario</th>
											<th class="text-right">I.V.A.</th>
											<th class="text-right">Total</th>
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
