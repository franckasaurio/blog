<!DOCTYPE HTML>
 <META CHARSET="UTF-8">
<html>
	<header><center>
	<!--Esto es para que aparesca el nombre de usuario y las opciones-->
		<?php 
			session_start();
			if (isset($_SESSION['nombre'])) {
				echo "Bienvenido ".$_SESSION['nombre']." <a href='cerrarsesion.php'>Cerrar sesion</a> | ";
				if ($_SESSION['tipo']==1) 
					echo "<a href='cambiarusuario.php'> Control de usuarios </a>";
				if ($_SESSION['tipo']==2 or $_SESSION['tipo']==1) 
						echo "<a href='ntemas.php'>| Añadir nuevo tema</a>"; 
			}	
			else
				echo "Bienvenido <a href='login.php'>Inicia sesion</a> o <a href='registro.php'>registrate</a>";
			?>
	</center></header>
	<body><center>
		<title>Blog de TIAV</title>
		<header><h1>Blog de TIA. Bienvenido
		<?php 
			if (isset($_SESSION['nombre'])) 
				echo $_SESSION['nombre'];
			echo "</h1></header>";
			include_once("settings/settings.inc.php");
			$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
			@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
			$sql="select temas.*,  usuarios.nombre from temas, usuarios where temas.id_usuario = usuarios.id order by fecha_pub desc; ";
			$temas=mysql_query($sql, $conexion);
			echo "<table width=90%>";
			while ($tema = @mysql_fetch_array($temas))
			{
				//Consulta de comentarios
				$sql = "select comentarios.*, usuarios.nombre from comentarios, usuarios, temas " .
					"where comentarios.id_usuario = usuarios.id and comentarios.id_tema = temas.id " .
					"and comentarios.id_tema = " . $tema['id'];
				$comentarios=mysql_query($sql, $conexion);

				echo "<tr>";
					echo "<td><b><h2>".$tema['titulo']."</h2></td>";	
					echo "<td align='right' width=20%>";
						//Mostrar botones segun el tipo del usuario
							if (isset($_SESSION['tipo'])) {
								if ($_SESSION['tipo']==2 or $_SESSION['tipo']==1) {	
									echo "<a href='ntemas.php?id=".$tema['id']."'>Editar | </a>";
									echo "<a href='ntemas.php?ideliminar=".$tema['id']."'>Eliminar | </a>";

								}
								//Me gusta
								//SELECT  count(*) from megusta where id_tema=
									$sqllikes="SELECT id, count(*) from megusta where id_tema=".$tema['id'].";";
									$likes=mysql_query($sqllikes, $conexion);
									$like= mysql_fetch_array($likes);
									$num=$like['count(*)'];
									echo "<a href='like.php?like=".$tema['id']."'>".$num." Likes</a>";
									echo "<a href='ncomentario.php?ncomentario=".$tema['id']."&prev=".$tema['id']."'> | Comentar |</a>";

							}
				echo "</td>";	
				echo "</tr>";
				echo "<tr><td><h5>".$tema['nombre']."</h5></td><td><i> Publicado el: ".$tema['fecha_pub']."</i></td></tr>";
				echo "<tr><td colspan='2'>".$tema['contenido']."</td></tr>";
				echo "<tr><td colspan='2'><b>Comentarios</b></td></tr>";
				$ncomentarios=0;
				while ($comentario = @mysql_fetch_array($comentarios)) {
					echo "<tr>";
						 echo "<td width=80% colspan=2>".$comentario['comentario']; 
						 echo " - <i>".$comentario['nombre']."</i>";
						 if (isset($_SESSION['tipo'])) {
						 	if ($_SESSION['tipo']==1) {	
						 		echo " - <a href='ncomentario.php?idcomentario=".$comentario['id']."&prev=".$tema['id']."'>Editar</a>";
							echo " - <a href='ncomentario.php?idcomentariodelete=".$comentario['id']."&prev=".$tema['id']."'>Eliminar</a>";
							}
						 }
					echo "</td>";
					echo "</tr>";
					$ncomentarios = $ncomentarios+1;
				}
				if ($ncomentarios < 1)
					echo "<tr><td colspan='2'><i>sin comentarios </i><a href='ncomentario.php?ncomentario=".$tema['id']."&prev=".$tema['id']."'>Añadir comentario</a></td></tr>";
			}
			echo "</table>";
			@mysql_close($conexion);
		?>
		</center>
	</body>
	<hr>
	<b>Un blog con 506 lineas de código</b>
</html>