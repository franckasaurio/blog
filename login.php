<?php 
 //Mensajes de error por si el logeo falla

	$error=0;
	$message="Bienvenido";
	if (isset($_GET["error"])) {
		$error= $_GET["error"];
		switch ($error) {
			case '1':
				$message="El usuario no existe";
				break;
			case '2':
				$message="El contraseña es incorrecta";
				break;
			case '3':
				$message="El usuario no existe";
				break;
			case '4':
				$message="El usuario se ha creado";
				break;
		}
	}
 ?>

<!DOCTYPE HTML>
<META CHARSET="UTF-8">
<html>
	<head>
	<title>Inicia sesión</title>
		<!-- Bootstrap -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body><center>
		<table border="0">	
			<tr><td><h1> Inicia Sesión </h1></td></tr>
			<form action="validarlogin.php" method="POST" name="login" id='contact-form' class='contact-form2'>
				<tr><td align="center"><b>
					<?php echo $message; ?>
				</b></td></tr>
				<tr><td> <input type="text" name="username" id="username" maxlength="15" placeholder="Usuario" size="25" </td></tr>
				<tr><td> <input type="password" name="userpwd" id="userpwd" maxlength="15" placeholder="Contraseña" size="25"></td><tr>
				<tr><td> <input type='submit' id='contact-form' class='submit' value='Iniciar sesión'> o <a href="registro.php">Registrate</a></td></tr>
			</form>
		</center></table>
		    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		    <!-- Include all compiled plugins (below), or include individual files as needed -->
		    <script src="js/bootstrap.min.js"></script>
	</body>
</html>
