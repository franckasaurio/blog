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
	<title>Inicia sesión</title>
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
	</body>
</html>
