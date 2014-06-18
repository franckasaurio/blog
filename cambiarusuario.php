<!DOCTYPE HTML>
 <META CHARSET="UTF-8">
<?php 
	session_start();
	if ($_SESSION['tipo']==1) {
		include_once("settings/settings.inc.php");
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
		
		/* Borrar usuarios */
		if (isset($_GET['idusr'])) {
			$sql="DELETE FROM usuarios WHERE id='".$_GET['idusr']."';";
			$eliminar=mysql_query($sql, $conexion);
		}
		

		$sql="SELECT * FROM blog.usuarios;";
		$usuarios=mysql_query($sql, $conexion);
		if (isset($_SESSION['nombre'])) {
			echo "<p align='right'>Hola ".$_SESSION['nombre']." ";
			echo "<a href='cerrarsesion.php'>Cerrar sesion </a>";
			echo "<a href='index.php'>| Página principal</a><p>";
			echo "<hr>";
		}
		?>
		<html>	
		<head>
			<title>Bienvenido Admin</title>
		    <!-- Bootstrap -->
		    <link href="css/bootstrap.min.css" rel="stylesheet">

		    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		    <!--[if lt IE 9]>
		      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		    <![endif]-->
		</head>
	<body>
		<center>	
		<h2>Control de usuarios</h2>
		</center>
		<form action="cambiarusuario.php" method="GET"> <table width=50% align='center'>
			<tr align='center'>
				<td ><b>Nombre</b></td><td><b>Usuario</b></td><td><b>Tipo</b></td><td colspan=2><b>Acciones</b></td>
			</tr>
			<tr><td colspan=5><hr></td></tr>
			<?php  
				while ($usuario = @mysql_fetch_array($usuarios)){
					echo "<tr align='center'>";
						echo "<td>".$usuario['nombre']."</td>";
						echo "<td>".$usuario['usuario']."</td>";
						echo "<td align='center'>".$usuario['tipo']."</td>";
						echo "<td align='center'><a href='registro.php?idusr=".$usuario['id']."'>Modificar</a>";
						echo "<td align='left'><a href='cambiarusuario.php?idusr=".$usuario['id']."'>Eliminar</a></td></td>";
					echo "</tr>";
				}
			?>
		</form></table>
		    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		    <!-- Include all compiled plugins (below), or include individual files as needed -->
		    <script src="js/bootstrap.min.js"></script>
	</body>
		</html>
		<?php
	}
	else
	{
		header("location:index.php");
	}
 ?>