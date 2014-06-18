<?php
	$mensaje="";
	include_once("settings/settings.inc.php");

	//Registro normal

	if (isset($_POST['pass'])) {
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());

		//Cambiar tipo al usuario por 1, 2, 3

		$idusr = $_POST['idusr'];
		if ($idusr > 0) {
			$update="UPDATE usuarios SET usuario='".$_POST['usuario']."', `password`='".$_POST['pass']."', `tipo`='".$_POST['tipo']."' WHERE `id`='".$idusr."';";
			$cambiartipo=mysql_query($update, $conexion) or die (mysql_error());	
		}
		else {
			$password = $_POST['pass'];
			if (strlen($password) > 4) {
				$nombre = $_POST['nombre'];
				$usuario = $_POST ['usuario'];
				$sql_usuarios="SELECT * FROM usuarios WHERE usuario = '$usuario'";
				$rs_usuarios=mysql_query($sql_usuarios, $conexion) or die (mysql_error());
				$total_usuarios=mysql_num_rows($rs_usuarios);
				if ($total_usuarios==0){
					$sql="INSERT INTO usuarios (nombre, usuario, password, tipo) VALUES ('".$nombre."', '".$usuario."', '".$password."', '3');";
					$registro=mysql_query($sql, $conexion) or die(mysql_error());
					header("location:login.php?error=4");
				}
				else {
					$mensaje = "El usuario ya existe";
		 		} 
			 }

			 else {
			 	$mensaje="<br><b>La contraseña es insegura<b><br>";
			 }
		}
	}

	/* Edicion */
	// si hay GET de idusr, lo cargas, y lo muestras en el formulario
	if (isset($_GET['idusr'])) {
		$idusr = $_GET['idusr'];
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
		$sql_usuarios= "SELECT * FROM usuarios where id='".$_GET['idusr']."';";
		$recordset1= mysql_query($sql_usuarios, $conexion) or die (mysql_error());
		$recordset= mysql_fetch_array($recordset1);
		$rnombre= $recordset['nombre'];
		$rusuario= $recordset['usuario'];
		$rpass=$recordset['password'];
		$rtipo= $recordset['tipo'];

	}
	else
	{
		$idusr = 0;
		$rnombre = "";
		$rusuario="";
		$rtipo="";
		$rpass="";
	}
 ?>
<!DOCTYPE HTML>
<META CHARSET="UTF-8">
<html>
	<head>
		<title>Registrate</title>
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
		<h1>Registrate</h1>
		<form action="registro.php" method="POST" name="registro" id='contact-form' class='contact-form2'>
		<table>
			<tr><td><b>Nombre:</b></td>
				<td><input type="hidden" name="idusr" value="<?php echo $idusr; ?>">
					<input type="text" name="nombre" placeholder="Ejemplo: Juan López"
					<?php echo "value='".$rnombre."'></td></tr>";?>
			<tr><td><b>Usuario:</b></td><td><input type="text" name="usuario"placeholder='Júan Lopez'
				<?php echo "value='".$rusuario."'></td></tr>";?>
			<tr><td><b>Contraseña:</b></td><td><input type="password" name="pass" placeholder="*******"value=<?php echo $rpass; ?>></td></tr>
			<?php echo $mensaje; ?>
			<!--Aqui inicia una seccion para cambiar el tipo de usuario-->
			<?php if (isset($_GET['idusr']))
				echo "<tr><td><b>Tipo</b></td><td><input type='text' name='tipo' placeholder='1, 2, 3' value='".$rtipo."'><td></tr>";
				else
				echo "<tr align='center'><td colspan='2'><i>Usted es usuario Tipo 3</i></td></tr>";
			 ?>
			<tr><td colspan='2'><input type='submit' value='Registrarme'> o <a href="login.php">Inicia Sesión</a></td></tr>
			
		</table>
		</form>
		</center>
		    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>
	</body>
</html>