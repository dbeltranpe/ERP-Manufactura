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
		<!-- HEADER MOBILE-->
		<header class="header-mobile d-block d-lg-none">
			<div class="header-mobile__bar">
				<div class="container-fluid">
					<div class="header-mobile-inner">
						<a class="logo" href="index.html"> <img
							src="../images/icon/logo.png" alt="CoolAdmin" />
						</a>
						<button class="hamburger hamburger--slider" type="button">
							<span class="hamburger-box"> <span class="hamburger-inner"></span>
							</span>
						</button>
					</div>
				</div>
			</div>
			<nav class="navbar-mobile">
				<div class="container-fluid">
					<ul class="navbar-mobile__list list-unstyled">
						<li><a href="index.php"> <i class="fas fa-tachometer-alt"></i>Dashboard
						</a></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-copy"></i>Inventario
						</a>
							<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
								<li><a href="login.html">Reportes</a></li>
								<li><a href="register.html">Agregar Insumos</a></li>
								<li><a href="forget-pass.html">Agregar Producto Terminado </a></li>
							</ul></li>

						<li><a href="chart.html"> <i class="fas fa-chart-bar"></i>Charts
						</a></li>
						<li><a href="table.html"> <i class="fas fa-table"></i>Tables
						</a></li>

						<li><a href="#"> <i class="fas fa-calendar-alt"></i>Calendar
						</a></li>
						<li><a href="map.html"> <i class="fas fa-map-marker-alt"></i>Maps
						</a></li>
						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-copy"></i>Pages
						</a>
							<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
								<li><a href="login.html">Login</a></li>
								<li><a href="register.html">Register</a></li>
								<li><a href="forget-pass.html">Forget Password</a></li>
							</ul></li>
						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-desktop"></i>UI Elements
						</a>
							<ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
								<li><a href="button.html">Button</a></li>
								<li><a href="badge.html">Badges</a></li>
								<li><a href="tab.html">Tabs</a></li>
								<li><a href="card.html">Cards</a></li>
								<li><a href="alert.html">Alerts</a></li>
								<li><a href="progress-bar.html">Progress Bars</a></li>
								<li><a href="modal.html">Modals</a></li>
								<li><a href="switch.html">Switchs</a></li>
								<li><a href="grid.html">Grids</a></li>
								<li><a href="fontawesome.html">Fontawesome Icon</a></li>
								<li><a href="typo.html">Typography</a></li>
							</ul></li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- END HEADER MOBILE-->

		<!-- MENU SIDEBAR-->
		<aside class="menu-sidebar d-none d-lg-block">
			<div class="logo">
				<a href="#"> <img src="../images/icon/logo.png" alt="Cool Admin" />
				</a>
			</div>
			<div class="menu-sidebar__content js-scrollbar1">
				<nav class="navbar-sidebar">
					<ul class="list-unstyled navbar__list">
						<li><a href="../principal/index.php"> <i
								class="fas fa-tachometer-alt"></i>Dashboard
						</a></li>

						<li class="has-sub"><a class="js-arrow" href="#"> <i
								class="fas fa-home"></i>Inventario
						</a>
							<ul class="list-unstyled navbar__sub-list js-sub-list">
								<li><a href="../modulos/inventario/reporte-inventario.php">Reportes</a>
								</li>
								<li><a href="">Insumos</a></li>
								<li><a href="">Producto Terminado</a></li>
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
													<a href="#"> <img src="../images/icon/avatar.jpg" />
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
													<a href="#"> <i class="zmdi zmdi-account"></i>Cuenta
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

				<div class="col-lg-6">
					<div class="card">
						<div class="card-header">Cambiar Datos Cuenta</div>
						<div class="card-body card-block">
							<form action="" method="post" class="">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type="text" id="username" name="username"
											placeholder="Username" class="form-control">
											
									<button type="submit" class="btn btn-success btn-sm" name="cambioUsuario">Cambiar</button>
								
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</div>
										<input type="email" id="email" name="email"
											placeholder="Email" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-asterisk"></i>
										</div>
										<input type="password" id="password" name="password"
											placeholder="Password" class="form-control">
									</div>
								</div>
								<div class="form-actions form-group">
									<button type="submit" class="btn btn-success btn-sm">Submit</button>
								</div>
							</form>
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
