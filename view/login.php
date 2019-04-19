<?php
session_set_cookie_params(0);
session_start();

require ($_SERVER['DOCUMENT_ROOT'] . '/erpbienesyservicios/controller/DAO/implementation/UsuarioDAO.class.php');

if (isset($_POST['submit'])) 
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $usuarioDAO = new UsuarioDAO();
    
    $salt = md5($password);
    $pasword_encriptado = crypt($password, $salt);
    
    $usuario = $usuarioDAO->getUsuarioLogin($username, $pasword_encriptado);

    if ($usuario) 
    {
            $_SESSION["loggedIn"] = true;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION["loggedIn"] = $usuario->codigo;
            
            if($usuario->rol==1)
            {
                header("Location:http://localhost/erpbienesyservicios/view/index.php");
            }
            
            else if($usuario->rol==2)
            {
                header("Location:");
            }
            
            else if($usuario->rol==3)
            {
                header("Location:");
            }
    } 
    
    else 
    {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>';
        
        echo '<script type="text/javascript">';
        echo "setTimeout(function () { Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Error en inicio de sesi&oacute;n',
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
<title>Login</title>

<!-- Fontfaces CSS-->
<link href="css/font-face.css" rel="stylesheet" media="all">
<link href="vendor/font-awesome-4.7/css/font-awesome.min.css"
	rel="stylesheet" media="all">
<link href="vendor/font-awesome-5/css/fontawesome-all.min.css"
	rel="stylesheet" media="all">
<link href="vendor/mdi-font/css/material-design-iconic-font.min.css"
	rel="stylesheet" media="all">

<!-- Bootstrap CSS-->
<link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet"
	media="all">

<!-- Vendor CSS-->
<link href="vendor/animsition/animsition.min.css" rel="stylesheet"
	media="all">
<link
	href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css"
	rel="stylesheet" media="all">
<link href="vendor/wow/animate.css" rel="stylesheet" media="all">
<link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet"
	media="all">
<link href="vendor/slick/slick.css" rel="stylesheet" media="all">
<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="vendor/perfect-scrollbar/perfect-scrollbar.css"
	rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
	<div class="page-wrapper">
		<div class="page-content--bge5">
			<div class="container">
				<div class="login-wrap">
					<div class="login-content">
						<div class="login-logo">
							<a href="#"> <img src="images/icon/logo.png" alt="CoolAdmin">
							</a>
						</div>
						<div class="login-form">
							<form action="" method="post">
								<div class="form-group">
									<label>Usuario</label> <input class="au-input au-input--full"
										type="text" name="username" placeholder="User">
								</div>
								<div class="form-group">
									<label>Contrase&ntilde;a</label> <input
										class="au-input au-input--full" type="password"
										name="password" placeholder="Password">
								</div>
								<div class="login-checkbox">
									<label> <a href="#">Se me olvido mi contrase&ntilde;a</a>
									</label>
								</div>
								<button class="au-btn au-btn--block au-btn--green m-b-20"
									type="submit" name="submit">Ingresar</button>

							</form>
							<!-- Documento esto porque todav�a no se sabe si registrarse se utilizar�
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="#">Sign Up Here</a>
                                </p>
                            </div>-->
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!-- Jquery JS-->
	<script src="vendor/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap JS-->
	<script src="vendor/bootstrap-4.1/popper.min.js"></script>
	<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
	<!-- Vendor JS       -->
	<script src="vendor/slick/slick.min.js">
    </script>
	<script src="vendor/wow/wow.min.js"></script>
	<script src="vendor/animsition/animsition.min.js"></script>
	<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
	<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
	<script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
	<script src="vendor/circle-progress/circle-progress.min.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="vendor/chartjs/Chart.bundle.min.js"></script>
	<script src="vendor/select2/select2.min.js">
    </script>

	<!-- Main JS-->
	<script src="js/main.js"></script>

</body>
    
    
</html>
<!-- end document-->