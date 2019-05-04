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
						
						if($_SESSION["rol"]==1)
						{
						    echo '<li><a href="../../principal/index.php"> <i';
						    echo ' class="fas fa-tachometer-alt"></i>Dashboard</a></li>';
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==2 || $_SESSION["rol"]==3 || $_SESSION["rol"]==4)
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-home"></i>Inventario</a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../inventario/reporte-inventario.php">Reportes</a></li>';
						    
						    if($_SESSION["rol"]==1 || $_SESSION["rol"]==2)
						    {
						        echo '<li><a href="../inventario/insumos-inventario.php">Insumos</a></li>';
						        echo '<li><a href="../inventario/productos-inventario.php">Producto Terminado</a></li>';
						    }
						    
						    echo'</ul></li>';
			
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==3 || $_SESSION["rol"]==4 )
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-truck"></i>Producci&oacute;n </a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../produccion/ordenes-produccion.php">Ordenes de Producci&oacute;n</a></li>';
						    echo '<li><a href="../produccion/trazabilidad-produccion.php">Ver Trazabilidad</a></li>';
						    echo '</ul></li>';
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==3 || $_SESSION["rol"]==4 || $_SESSION["rol"]==5 )
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-credit-card"></i>Ventas</a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../ventas/facturas.php">Facturas</a></li>';
						    echo '<li><a href="#">Estado de Ventas</a></li>';
						    echo '</ul></li>';
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==5)
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-dollar"></i>Finanzas</a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../finanzas/cuentas-finanzas.php">Cuentas</a></li>';
						    echo '<li><a href="../finanzas/analisis-cuentas.php">An&aacute;lisis</a></li>';
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
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						
						<div class="col" style="width: 100%">
							<section class="card">
								<div class="card-header" align="center"><b>Facturas Pagadas</b></div>
								<div class="card-body" align="center">
									<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">1500</label>
										</div>
								</div>
							</section>
						</div>
						<div class="col" style="width: 100%">
							<section class="card">
								<div class="card-header" align="center"><b>Facturas en proceso de pago</b></div>
								<div class="card-body" align="center">
									<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">100</label>
										</div>
								</div>
							</section>
						</div>
						
						<div class="col" style="width: 100%">
							<section class="card">
								<div class="card-header" align="center"><b>Total Ganancias</b></div>
								<div class="card-body" align="center">
									<div class="form-group">
											<label for="cc-payment" class="control-label mb-1">3'000.000</label>
										</div>
								</div>
							</section>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="table-responsive table--no-card m-b-30">
								<div style="align-self: center;">
									<h3 class="text-center title-2"><b>Facturas Pagadas</b></h3>
								</div>
								<table
									class="table table-borderless table-striped table-earning">
									<thead>
										<tr>
											<th>N&uacute;mero de factura</th>
											<th>Cliente</th>
											<th>Producto</th>
											<th>Cantidad</th>
											<th>Fecha de factura</th>
											<th>Total</th>
											<th>Estado</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>2</td>
											<td>Surtimax</td>
											<td>Ponque Ramo</td>
											<td>500</td>
											<td>2019-03-22 10:00</td>
											<td>300000</td>
											<td>Pagado</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Alqur&iacute;a</td>
											<td>Esferos</td>
											<td>100</td>
											<td>2019-10-22 14:30</td>
											<td>25000</td>
											<td>Pagado</td>
										</tr>
										<tr>
											<td>5</td>
											<td>Brisa</td>
											<td>Almohadas</td>
											<td>60</td>
											<td>2019-03-22 10:00</td>
											<td>1000000</td>
											<td>Pagado</td>
										</tr>
										<tr>
											<td>6</td>
											<td>Electr&oacute;nica S.A.S</td>
											<td>Resistencias</td>
											<td>200000</td>
											<td>2019-03-22 10:00</td>
											<td>500000</td>
											<td>Pagado</td>
										</tr>
										<tr>
											<td>8</td>
											<td>Luis Salvador</td>
											<td>Billeteras</td>
											<td>5</td>
											<td>2019-03-22 10:00</td>
											<td>100000</td>
											<td>Pagado</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>
					
					<div class="row">
						<div class="col">
							<div class="table-responsive table--no-card m-b-30">
								<div style="align-self: center;">
									<h3 class="text-center title-2"><b>Facturas En Proceso de pago</b></h3>
								</div>
								<table
									class="table table-borderless table-striped table-earning">
									<thead>
										<tr>
											<th>N&uacute;mero de factura</th>
											<th>Cliente</th>
											<th>Producto</th>
											<th>Cantidad</th>
											<th>Fecha de factura</th>
											<th>Total</th>
											<th>Estado</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Roberto</td>
											<td>Tornillos</td>
											<td>1000</td>
											<td>2019-05-05 08:00</td>
											<td>5000</td>
											<td>En proceso de pago</td>
										</tr>
										<tr>
											<td>4</td>
											<td>Ramon</td>
											<td>Carcasas Celulares</td>
											<td>2</td>
											<td>2019-08-10 12:47</td>
											<td>150000</td>
											<td>En porceso de pago</td>
										</tr>
										<tr>
											<td>7</td>
											<td>Movilizador Andino</td>
											<td>Barras de Acero</td>
											<td>100</td>
											<td>2019-03-22 10:00</td>
											<td>2500000</td>
											<td>En proceos de pago</td>
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