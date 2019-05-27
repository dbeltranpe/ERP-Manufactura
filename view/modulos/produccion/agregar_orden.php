<?php
session_set_cookie_params(0);
session_start();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InsumoDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/OrdenProduccionDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ItemProductoDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ProductoDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InventarioProductoDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/InventarioInsumoDAO.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrazabilidadProduccionDAO.class.php');

if ($_SESSION["loggedIn"] != true) {
    header("Location:https://bienesyservicios.webcindario.com/erpbienesyservicios/view/principal/login.php");
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location:https://bienesyservicios.webcindario.com/erpbienesyservicios/view/principal/login.php");
    exit();
}

$trabajadorDAO = new TrabajadorDAO();
$trabajador = $trabajadorDAO->getTrabajador($_SESSION["loggedIn"]);

$ord_ProduccionDAO = new OrdenProduccionDAO();
$insumoDAO = new InsumoDAO();
$itemProdcDAO = new ItemProductoDAO();
$productoDAO = new ProductoDAO();
$inv_productoDAO = new InventarioProductoDAO();
$inv_insumosDAO = new InventarioInsumoDAO();
$trazabilidad = new TrazabilidadProduccionDAO();

if (isset($_POST['agregarOrden'])) {
    $nomP = $_POST['nom'];
    $cantidadP = $_POST['cant1'];
    $valor_unitario = $_POST['val_u'];
    $fechaI = $_POST['fi'];
    $fechaE = $_POST['fe'];
    $almacen = $_POST['alm'];
    $estado = 1;

    $item1 = $_POST['item_1'];
    $cantidad_Item1 = $_POST['cant_item1'];
    $item2 = $_POST['item_2'];
    $cantidad_Item2 = $_POST['cant_item2'];
    $item3 = $_POST['item_3'];
    $cantidad_Item3 = $_POST['cant_item3'];
    $item4 = $_POST['item_4'];
    $cantidad_Item4 = $_POST['cant_item4'];
    $item5 = $_POST['item_5'];
    $cantidad_Item5 = $_POST['cant_item5'];
    $item6 = $_POST['item_6'];
    $cantidad_Item6 = $_POST['cant_item6'];

    $continuar = true;
    $items = array(
        $item1,
        $cantidad_Item1,
        $item2,
        $cantidad_Item2,
        $item3,
        $cantidad_Item3,
        $item4,
        $cantidad_Item4,
        $item5,
        $cantidad_Item5,
        $item6,
        $cantidad_Item6
    );
    
    $cont = 0;
    for ($i = 0; $i < 6; $i = $i + 2) 
    {
        if($items[$i] != 0)
        {
            $cant_insumos = $inv_insumosDAO->getInventarioInsumo($items[$i]);
            $cant_final = $cant_insumos->getCantidad() - $items[$i+1];
            
            $cont = $cont + 2;
            if ($cant_final < 0) 
            {
                $continuar = false;
            }
        }
    }

    if ($continuar == true) 
    {
        $exiProducto = $productoDAO->getProducto($nomP);

        if (sizeof($exiProducto) == 0) 
        {
            $productoDAO->save($nomP, 0.19, $valor_unitario);

            $savedProducto = $productoDAO->getProducto($nomP);
            $inv_productoDAO->save($savedProducto[0]->getCodigo(), $cantidadP);
        } 
        else 
        {
            $savedProducto = $productoDAO->getProducto($nomP);
            $inv_productoDAO->save($savedProducto[0]->getCodigo(), $cantidadP);
        }
        
        $valor_insumos = 0;
        for ($i = 0; $i < $cont; $i = $i + 2) 
        {
            $insumo = $insumoDAO->getInsumo($items[$i]);
            $valor_iva_insumos = $insumo->getIva() * $insumo->getValor();
            $valor_insumos = $valor_insumos + ($insumo->getValor() * $items[$i+1]) + $valor_iva_insumos;
            
            $cant_final = $cant_insumos->getCantidad() - $items[$i+1];
            $inv_insumosDAO->updateInventarioInsumo($items[$i], $cant_final);
        }
        
        $exiProducto2 = $productoDAO->getProducto($nomP);
        $valor_iva_productos = $exiProducto2[0]->getIva();
        $valor_productos = ($exiProducto2[0]->getValor() * $cantidadP) + $valor_iva_productos;
        
        $costo_final = $valor_insumos + $valor_productos;

        $ord_ProduccionDAO->save($nomP, $cantidadP, $fechaI, $fechaE, $costo_final, $almacen, $estado);

        $codigo = $ord_ProduccionDAO->obtenerCodUltimaFila();
        
        for ($i = 0; $i < $cont; $i = $i +2) 
        {
            $itemProdcDAO->save($codigo, $items[$i], $items[$i+1]);
        }
        
        $nomProducc = $ord_ProduccionDAO->getOrdenProduccionByName($nomP);
        $trazabilidad->save("Agrego Orden", $nomProducc->getCod_orden_produccion(), $nomProducc->getNom_producto(), $nomProducc->getCantidad(), $nomProducc->getCosto_fabricacion());
     
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
				<div class="container-fluid" style="width: 95%; align-self: center;">

					<div class="row">
						<section class="card" style="width: 100%; align-self: center;">
							<div class="card-body" style="width: 100%; align-self: center;">
								<div class="card-title">
									<h3 class="text-center title-2">Datos del Producto</h3>
								</div>
								<hr>
								<form action="" method="post" novalidate="novalidate">

									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1">Nombre del
											Producto</label> <input id="nom" name="nom" type="text"
											class="form-control" aria-required="true"
											aria-invalid="false">

									</div>

									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1">Cantidad</label>
										<input id="cant1" name="cant1" type="number"
											class="form-control" aria-required="true"
											aria-invalid="false">
									</div>

									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1">Valor
											Unitario</label> <input id="val_u" name="val_u" type="number"
											class="form-control" aria-required="true"
											aria-invalid="false">
									</div>

									<div class="form-group">

										<div style="width: 49%; float: left;">
											<div>
												<label for="cc-payment" class="control-label mb-1">Materiales
													a usar</label>
											</div>

											<div class="form-group">
												<select id='item_1' name="item_1" class=" form-control">
													<option value="0">- - -</option>
                                       	 	<?php

                                        $insumos = $insumoDAO->listarInsumos();

                                        for ($i = 0; $i < sizeof($insumos); $i ++) {
                                            echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                        }

                                        ?>                                 
    										</select>
											</div>
											<div class="form-group">
												<select id='item_2' name="item_2" class=" form-control">
													<option value="0">- - -</option>
                                       	 	<?php

                                        $insumos = $insumoDAO->listarInsumos();

                                        for ($i = 0; $i < sizeof($insumos); $i ++) {
                                            echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                        }

                                        ?>                                 
    										</select>
											</div>
											<div class="form-group">
												<select id='item_3' name="item_3" class=" form-control">
													<option value="0">- - -</option>
                                       	 	<?php

                                        $insumos = $insumoDAO->listarInsumos();

                                        for ($i = 0; $i < sizeof($insumos); $i ++) {
                                            echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                        }

                                        ?>                                 
    										</select>
											</div>
											<div class="form-group">
												<select id='item_4' name="item_4" class=" form-control">
													<option value="0">- - -</option>
                                       	 	<?php

                                        $insumos = $insumoDAO->listarInsumos();

                                        for ($i = 0; $i < sizeof($insumos); $i ++) {
                                            echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                        }

                                        ?>                                 
    										</select>
											</div>
											<div class="form-group">
												<select id='item_5' name="item_5" class=" form-control">
													<option value="0">- - -</option>
                                       	 	<?php

                                        $insumos = $insumoDAO->listarInsumos();

                                        for ($i = 0; $i < sizeof($insumos); $i ++) {
                                            echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                        }

                                        ?>                                 
    										</select>
											</div>
											<div class="form-group">
												<select id='item_6' name="item_6" class=" form-control">
													<option value="0">- - -</option>
                                       	 	<?php

                                        $insumos = $insumoDAO->listarInsumos();

                                        for ($i = 0; $i < sizeof($insumos); $i ++) {
                                            echo "<option value='" . $insumos[$i]->getCodigo() . "'>" . $insumos[$i]->getNombre() . "</option>";
                                        }

                                        ?>                                 
    										</select>
											</div>
										</div>

										<div style="width: 49%; float: right;">
											<div>
												<label for="cc-payment" class="control-label mb-1">Cantidad
													Total</label>
											</div>

											<div class="form-group">
												<input id="cant_item1" name="cant_item1" type="number"
													class="form-control" aria-required="true"
													aria-invalid="false">
											</div>

											<div class="form-group">
												<input id="cant_item2" name="cant_item2" type="number"
													class="form-control" aria-required="true"
													aria-invalid="false">
											</div>

											<div class="form-group">
												<input id="cant_item3" name="cant_item3" type="number"
													class="form-control" aria-required="true"
													aria-invalid="false">
											</div>

											<div class="form-group">
												<input id="cant_item4" name="cant_item4" type="number"
													class="form-control" aria-required="true"
													aria-invalid="false">
											</div>

											<div class="form-group">
												<input id="cant_item5" name="cant_item5" type="number"
													class="form-control" aria-required="true"
													aria-invalid="false">
											</div>
											<div class="form-group">
												<input id="cant_item6" name="cant_item6" type="number"
													class="form-control" aria-required="true"
													aria-invalid="false">
											</div>
										</div>

									</div>

									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1">Fecha de
											Inicio</label> <input id="fi" name="fi" type="date"
											class="form-control" aria-required="true"
											aria-invalid="false">
									</div>

									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1">Fecha de
											Entrega</label> <input id="fe" name="fe" type="date"
											class="form-control" aria-required="true"
											aria-invalid="false">
									</div>

									<div class="form-group">
										<label for="cc-payment" class="control-label mb-1">Almac&eacute;n
											de destino</label> <select id="alm" name="alm"
											class="form-control" aria-required="true"
											aria-invalid="false">

											<option value="Zapatos la Corona Sede chic&oacute;">Zapatos
												la Corona Sede chic&oacute;</option>
											<option value="Zapatos la Corona Sede Ricaurte">Zapatos la
												Corona Sede Ricaurte</option>
											<option value="Zapatos la Corona Sede Cantalejo">Zapatos la
												Corona Sede Cantalejo</option>
											<option value="Zapatos la Corona Sede Cali">Zapatos la Corona
												Sede Cali</option>

										</select>
									</div>

									<div>
										<button id="agregarOrden" name="agregarOrden" type="submit"
											class="btn btn-lg btn-info btn-block">
											<i class="fa fa-check-circle"></i>&nbsp; <span
												id="payment-button-amount">Agregar</span>
										</button>
									</div>
								</form>
							</div>
						</section>
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