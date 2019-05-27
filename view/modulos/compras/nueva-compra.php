<?php
session_set_cookie_params(0);
session_start();

require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/TrabajadorDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/MPagoDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/ProveedorDAO.class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/CompraDAO.class.php');

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

$pagoDAO = new MPagoDAO();
$proveedorDAO = new ProveedorDAO();
$compraDAO = new CompraDAO();

if (isset($_POST['nuevaCompra'])) {

    $nomData = $_POST["noms"];
    $canData = $_POST["cans"];
    $preData = $_POST["pres"];
    $totData = $_POST["tots"];

    $a = explode(",", $nomData);
    $b = explode(",", $canData);
    $c = explode(",", $preData);
    $d = explode(",", $totData);

    $provData = $_POST["nomPro"];
    $pagoData = $_POST["nomPago"];
    $timeData = $_POST["nomTiempo"];

    $totCantidad = $_POST["totcan"];
    $totSuma = $_POST["totsum"];

    $compraDAO->save($trabajador->getNombre(), $a, $b, $c, $d, $provData, $pagoData, $timeData, $totCantidad, $totSuma);
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
  // Refresca Producto: Refresco la Lista de Productos dentro de la Tabla
  // Si es vacia deshabilito el boton guardar para obligar a seleccionar al menos un producto al usuario
  // Sino habilito el boton Guardar para que pueda Guardar
  var arregloCount = [];
  var nombres = [];
  var cantidades = [];
  var precios = [];
  var totales = [];
  var contador = 0;
  var SumCan = 0;
  var SumTot = 0;
  var nomNew = [];
  var canNew = [];
  var preNew = [];
  var totNew = [];
  var counter = 0;

  function busqueda(numero, pos){
  	for (var i = 0; i < arregloCount.length; i++) {
  		contenido = arregloCount[i][0];
  		if(numero == contenido) {
  			return i;
  		} else {
  			return -1;
  		}
  	}
}
    function borrarItem(numero) {
      var resCan = 0;
      var resTot = 0;

      resCan = $("#can"+numero+"").val();
      SumCan = SumCan-resCan;
      document.getElementById("res1").value = SumCan;

      resTot = $("#tot"+numero+"").val();
      SumTot = SumTot-resTot;
      document.getElementById("res2").value = SumTot;

      var posN = nombres[numero-1];
      nombres.splice(posN-1,1);

      var posC = cantidades[numero-1];
      cantidades.splice(posC-1,1);

      var posP = precios[numero-1];
      precios.splice(posP-1,1);

      var posT = totales[numero-1];
      totales.splice(posT-1,1);

      counter--;

      if (counter == 0) {
		$('#sent').attr('disabled','disabled');
	  }
    }
    function envio(){

    	nomNew = [];
    	canNew = [];
    	preNew = [];
    	totNew = [];

    	for (var i = 0; i < nombres.length; i++) {
    		nomNew.push($("#"+nombres[i]).val());
    		canNew.push($("#can"+cantidades[i]).val());
    		preNew.push($("#pre"+precios[i]).val());
    		totNew.push($("#tot"+totales[i]).val());
    	}

    	document.getElementById("noms").value = nomNew;
    	document.getElementById("cans").value = canNew;
    	document.getElementById("pres").value = preNew;
    	document.getElementById("tots").value = totNew;
    	document.getElementById("totcan").value = SumCan;
    	document.getElementById("totsum").value = SumTot;
    }
       function agregarProducto() {

            if($('#name').val() != '' && $('#cantidad_').val() != '' && $('#precio_').val() != ''){
              var sel = $('#name').val(); //Capturo el Value del Producto
              var a = $('#quantity').val();
              var b = $('#prize').val();
              var suma = a*b;

              contador ++;
              counter++;
              var newtr = '<tr class="item"  data-id="'+sel+'">';
              newtr = newtr + '<td class="iProduct"><input type="text" class="form-control" disabled id="'+contador+'" name="nombre_'+contador+'" required style="font-size: 12px;" value="'+sel+'" /></td>';
              newtr = newtr + '<td><input type="number" class="form-control" disabled id="can'+contador+'" name="cantidad_'+contador+'" required style="font-size: 12px;" value="'+a+'" /></td>';
              newtr = newtr + '<td><input type="number" id="pre'+contador+'" class="form-control" disabled name="precio_'+contador+'" required style="font-size: 12px;" value="'+b+'" /></td>';
              newtr = newtr + '<td><input  class="form-control" disabled style="font-size: 12px;" id="tot'+contador+'" name="cantidad_'+contador+'" value="'+suma+'" required /></td>';
              newtr = newtr + '<td><button type="button" onclick="borrarItem('+contador+')" class="btn btn-danger remove-item" style="width: 70px;"><i class="fa fa-close" style="size: 50px"></i></button></td></tr>';

              if (counter != 0) {
			    $('#sent').removeAttr('disabled','disabled');
			  }

              arregloCount.push(["precio_"+contador, "cantidad_"+contador, "total_"+contador,""]);
              nombres.push(contador);
              cantidades.push(contador);
              precios.push(contador);
              totales.push(contador);

              $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected

              SumCan += parseInt($("#can"+contador+"").val());
              SumTot += parseInt($("#tot"+contador+"").val());

              document.getElementById("res1").style.display = "block";
              document.getElementById("sp1").style.display = "block";
              document.getElementById("res1").value = SumCan;

              document.getElementById("res2").style.display = "block";
              document.getElementById("sp2").style.display = "block";
              document.getElementById("res2").value = SumTot;

              $('.remove-item').off().click(function(e) {
              	busqueda();
                  $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
                  if ($('#ProSelected tr.item').length == 0)
                      $('#ProSelected .no-item').slideDown(300);
              });        
           } else {
             alert("Debe completar todos los campos");
          }
        }
</script>
<script type="text/javascript">
    $(document).ready(function() { 
    $('#clean').click(function() {
    $('#name').val('');
    $('#quantity').val('');
    $('#prize').val('');
    });
  });
</script>
<!-- Title Page-->
<title>Nueva Compra</title>

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

<!-- Main CSS-->
<link href="../../css/theme.css" rel="stylesheet" media="all">

</head>
<!-- Fontfaces CSS-->

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
										   	<img src="../../images/icon/avatar.jpg" />
										</div>
										<div class="content">
											<a class="js-acc-btn" href="#" id="nombre_cuenta_1">
											Daniel Penagos</a>
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
														admin</a>
													</h5>
													<span class="email" id="correo_cuenta">
													beltranpenagos@gmail.com</span>
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
					<div class="container" width="800px" style="background-color: white;">
						<div class="row">
							<div class="col-12 text-center bg-info" style="padding: 10px; color: #FFF;">FACTURACI&Oacute;N</div>
						</div>
						<div class="container">
				  	    <form action="#" method="POST">
				  	        <h2 style="margin-top: 20px;">Comprar productos</h2>
				  	       	<div style="width: 100%; background: darkgrey; margin-top: 20px; padding: 5px;"> 
					  	        <button type="button" id="clean" onclick="agregarProducto()" class="btn btn-info" style="width: 70px;"><i class="fa fa-plus-circle" style="font-size: 12px; margin-top: 2px;"></i></button>
					  	        <input class="text-center" type="text" id="name" placeholder="Nombre" >
					  	       	<input type="number" id="quantity" class="text-center" placeholder="Cantidad total" >
					  	   		  <input type="number" id="prize" class="text-center" placeholder="Precio unitario" >
					  	   	</div>
				  	        <table id="TablaPro" class="table" style="margin-top: 10px;">
				  	            <thead>
				  	                <tr>
				  	                    <th>Producto</th>
				  	                    <th>Cantidad</th>
				  	                    <th>Precio Unidad</th>
				  	                    <th>Total</th>
				  	                </tr>
				  	            </thead>
				  	            <tbody id="ProSelected"></tbody>
				  	        </table>
				  			<div class="row" style="margin-top: 15px;">
					          <div class="col-3">
					          <select name="nomPro" class="form-control" style="font-size: 15px; width: 230px; height: 32px;">
					            	<?php
                                    $proveedores = $proveedorDAO->listarProveedores();
                                    for ($i = 0; $i < sizeof($proveedores); $i ++) { ?>
                                        <option value="<?php echo($proveedores[$i]['cod_proveedor']); ?>">
                                        <?php echo($proveedores[$i]['nom_proveedor']); ?></option>
                                    <?php } ?>
					          </select>
					          </div>
					          <div class="col-3">
					            <select name="nomPago" class="form-control" style="font-size: 15px; width: 260px; height: 32px; margin-left: -15px;">
                                        <?php
                                        $pagos = $pagoDAO->listarPagos();
                                        for ($i = 0; $i < sizeof($pagos); $i ++) { ?>
                                            <option value="<?php echo($pagos[$i]['cod_m_pago']); ?>">
                                            <?php echo($pagos[$i]['nom_m_pago']); ?></option>
                                        <?php } ?>
					            </select>
					          </div>
					          <div class="col-3">
					          	<select name="nomTiempo" class="form-control" style="font-size: 15px; width: 260px; height: 32px;">
						          	<option value="1">Pago inmediato</option>
						          	<option value="2">Pago a futuro</option>
						        </select>
					          </div>
					        </div>
				            <div class="row" style="margin-top: 22px;">
				                  <span id="sp1" class="col-2" style="display: none;">Total de cantidad:</span>
				                  <input id="res1" disabled class="col-2" style="display: none; margin-left: -50px;" type="text">
				                  <span id="sp2" class="col-2" style="display: none;">Total de la compra:</span>
				                  <input id="res2" disabled class="col-2" style="display: none; margin-left: -50px;" type="text">
				            </div>
				            <input type="text" hidden name="noms" id="noms">
				            <input type="text" hidden name="cans" id="cans">
				            <input type="text" hidden name="pres" id="pres">
				            <input type="text" hidden name="tots" id="tots">
				            <input type="number" hidden name="totcan" id="totcan">
				            <input type="number" hidden name="totsum" id="totsum">
				            <button  onclick="envio();" id="sent" disabled type="submit" name="nuevaCompra" class="btn btn-lg btn-info btn-block" style="margin-top: 20px;">
				                <i class="fa fa-check-circle"></i>&nbsp; <span id="payment-button-amount">Agregar</span>
				             </button>
				         </form>
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
	<script src="../../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
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
</html>
<!-- end document-->