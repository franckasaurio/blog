<?php
	session_start();
	if ($_SESSION['id']>1) {
		include_once("settings/settings.inc.php");
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());

		//ELIMINAR UN TEMA
		if (isset($_GET['ideliminar'])) {
				$sql_eliminartemas= "DELETE FROM blog.temas where id='".$_GET['ideliminar']."';";
				$eliminame= mysql_query($sql_eliminartemas, $conexion) or die (mysql_error());
				$recordset12= mysql_fetch_array($eliminame);
				header('location:index.php');
		}
		//Editar Temas
		if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$sql_temas= "SELECT * FROM blog.temas where id='".$_GET['id']."';";
				$recordset1= mysql_query($sql_temas, $conexion) or die (mysql_error());
				$recordset= mysql_fetch_array($recordset1);
				$rtitulo= $recordset['titulo'];
				$rcontenido= $recordset['contenido'];
				$id_usuario=$recordset['id_usuario'];
				$rid= $recordset['id'];
		}
		else
		{
			$rtitulo= "";
			$rcontenido= "";
			$id_usuario="";
			$rid= "";
		}
		if (isset($_POST['contenido'])) {
			session_start();
			$tema = $_POST['tema']; 
			$contenido = $_POST['contenido'];
			if ($_POST['idtema'] > 0) {
				$update="UPDATE blog.temas SET titulo='".$tema."', contenido='".$contenido."' WHERE id='".$_POST['idtema']."';";
				$cambiartema=mysql_query($update, $conexion) or die (mysql_error());
				header("location:index.php");
			}
			else{
				$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
				$db = @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
				$sql="INSERT INTO blog.temas (id_usuario, titulo, contenido) VALUES ('".$_SESSION['id']."', '".$tema."', '".$contenido."')";
				$registro=mysql_query($sql, $conexion);
				header("location:index.php");
			}	
		}
	}
	else {
		header('location:index.php');
	}
	 ?>
	<!DOCTYPE HTML>
	<META CHARSET="UTF-8">
	<html>
		<head>
			<title>Cambio de tema</title>
			  <link href="css/bootstrap.min.css" rel="stylesheet">

		    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		    <!--[if lt IE 9]>
		      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		    <![endif]-->
		</head>
		<body>
		<center><br>
			<h2>AÑADE EL NUEVO CONTENIDO AL BLOG</h2>
				<form action="ntemas.php" method="POST" name="comentario">
					<input type="hidden" name="idusr" value="<?php echo $id_usuario; ?>">
					<input type="hidden" name="idtema" value="<?php echo $id; ?>">
					<input type="text" name="tema" id="tema" placeholder="Titulo del blog" size="100" value="<?php echo $rtitulo; ?>"><br><br>
					<textarea name="contenido" id="contenido" cols="130" rows="10" placeholder="Presiona para insertar tu texto o contenido"><?php echo $rcontenido; ?></textarea><br>
					<input type="submit" value="Publicar tema">
					<a href='index.php'> Cancelar</a>
				</form>
		</center>
		    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		    <!-- Include all compiled plugins (below), or include individual files as needed -->
		    <script src="js/bootstrap.min.js"></script>
		</body>
	</html>