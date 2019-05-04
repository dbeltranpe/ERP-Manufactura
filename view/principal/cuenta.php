<?php
session_set_cookie_params(0);
session_start();

require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/UsuarioDAO.class.php');

if ($_SESSION["loggedIn"] != true) {
    header("Location:localhost/erpbienesyservicios/view/principal/login.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location:localhost/erpbienesyservicios/view/principal/login.php");
    exit();
}

$trabajadorDAO = new TrabajadorDAO();
$trabajador = $trabajadorDAO->getTrabajador($_SESSION["loggedIn"]);
$usuarioDAO = new UsuarioDAO();

if (isset($_POST['actualizar']))
{
    $viejaContraseña = $_POST['vieja_password'];
    
    if($viejaContraseña != $_SESSION["password"])
    {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>';
        
        echo '<script type="text/javascript">';
        echo "setTimeout(function () { Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'La vieja contrase&ntilde;a no coincide',
                showConfirmButton: false,
                timer: 3000
                });";
        echo '}, 1000);</script>';
    }
    
    else
    {
        $nuevoNombre     = $_POST['nom_cuenta'];
        $nuevoCorreo     = $_POST['email'];
        $nuevaContraseña = $_POST['nueva_password'];
        $cod_usuario = $_SESSION["loggedIn"];
        
        $trabajadorDAO->updateTrabajador($cod_usuario, $nuevoNombre, $nuevoCorreo);
        $usuarioDAO->updateUsuario($cod_usuario, $nuevaContraseña);
        
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>';
        
        echo '<script type="text/javascript">';
        echo "setTimeout(function () { Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Se ha actualizado la informaci&oacute;n',
                showConfirmButton: false,
                timer: 3000
                });";
        echo '}, 1000);</script>';
        
    }
    
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

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
						    echo '<li><a href="../modulos/inventario/reporte-inventario.php">Reportes</a></li>';
						    
						    if($_SESSION["rol"]==1 || $_SESSION["rol"]==2)
						    {
						        echo '<li><a href="../modulos/inventario/insumos-inventario.php">Insumos</a></li>';
						        echo '<li><a href="../modulos/inventario/productos-inventario.php">Producto Terminado</a></li>';
						    }
						    
						    echo'</ul></li>';
			
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==3 || $_SESSION["rol"]==4 )
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-truck"></i>Producci&oacute;n </a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../modulos/produccion/ordenes-produccion.php">Ordenes de Producci&oacute;n</a></li>';
						    echo '<li><a href="../modulos/produccion/trazabilidad-produccion.php">Ver Trazabilidad</a></li>';
						    echo '</ul></li>';
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==3 || $_SESSION["rol"]==4 || $_SESSION["rol"]==5 )
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-credit-card"></i>Ventas</a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../modulos/ventas/facturas.php">Facturas</a></li>';
						    echo '<li><a href="../modulos/ventas/estado-ventas.php">Estado de Ventas</a></li>';
						    echo '</ul></li>';
						}
						
						if($_SESSION["rol"]==1 || $_SESSION["rol"]==5)
						{
						    echo '<li class="has-sub"><a class="js-arrow" href="#"> <i';
						    echo ' class="fas fa-dollar"></i>Finanzas</a>';
						    echo '<ul class="list-unstyled navbar__sub-list js-sub-list">';
						    echo '<li><a href="../modulos/finanzas/cuentas-finanzas.php">Cuentas</a></li>';
						    echo '<li><a href="../modulos/finanzas/analisis-cuentas.php">An&aacute;lisis</a></li>';
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
							<form method="post">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user"></i>
										</div>
										<input type="text" id="nom_cuenta" name="nom_cuenta"
											placeholder="Nombre Cuenta" class="form-control" value=<?php echo "'" . utf8_encode($trabajador->nombre) . "'"; ?>>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</div>
										<input type="email" id="email" name="email"
											placeholder="Email" class="form-control" value=<?php echo "'" . utf8_encode($trabajador->correo) . "'"; ?>>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-asterisk"></i>
										</div>
										<input type="password" name="nueva_password"
											placeholder="Nueva Contrase&ntilde;a" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-asterisk"></i>
										</div>
										<input type="password" name="vieja_password"
											placeholder="Vieja Contrase&ntilde;a" class="form-control" >
									</div>
								</div>
								
								<div class="form-actions form-group">
									<button type="submit" class="btn btn-success btn-sm"  name="actualizar" >Actualizar Informaci&oacute;n</button>
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
