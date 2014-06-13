<?php
	//Iniciar Base de Datos y Conexión
	include_once("settings/settings.inc.php");
	$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
	$db = @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());

	// aparecer tema para guiarte
	if (isset($_GET['prev'])) {
		$sqlprev="SELECT * FROM temas WHERE id='".$_GET['prev']."'";
		$prevtemas=mysql_query($sqlprev, $conexion);
		$temasprev= mysql_fetch_array($prevtemas);
		$tema=$temasprev['titulo'];
		$contenidotema=$temasprev['contenido'];
	}
	else {
		$tema="";
		$contenidotema="";
	}

	//Eliminar Comentario
	if (isset($_GET['idcomentariodelete'])) {
		$sql="DELETE FROM comentarios WHERE id='".$_GET['idcomentariodelete']."'";
		$registro=mysql_query($sql, $conexion);
		header("location:index.php");
	}


	//Crear Comentario

	if (isset($_POST['contenido'])) {
		session_start();
		$temaid=$_POST['idtema'];
		if (isset($_SESSION["id"])) {
			if (isset($_POST['iddecomentario'])) {
				if ($_POST['iddecomentario']>0) {
					$update="UPDATE comentarios SET comentario='".$_POST['contenido']."' WHERE id='".$_POST['iddecomentario']."';";
					$editarcomentario=mysql_query($update, $conexion) or die (mysql_error());
					header("location:index.php");
				}
			}
			if ($temaid>0) {
				$comentario = $_POST['contenido']; 
				$sql="INSERT INTO comentarios (id_usuario, id_tema, comentario) VALUES ('".$_SESSION["id"]."', '".$_POST['idtema']."', '".$comentario."');";
				$comentarionuevo=mysql_query($sql, $conexion);
				header("location:index.php");
			}
			else
				header("location:index.php");
		}
		else
			header("location:login.php");			
	}
	//Editar un Comentario
	if (isset($_GET['idcomentario'])) {
		$idcoment=$_GET['idcomentario'];
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
		$sql_editar= "SELECT * FROM comentarios where id='".$idcoment."';";
		$recordset1= mysql_query($sql_editar, $conexion) or die (mysql_error());
		$recordset= mysql_fetch_array($recordset1);
		$contenido=$recordset['comentario'];
		$iddecomentario=$recordset['id'];
	}
	else {
		$contenido="";
		$iddecomentario=0;
	}
 ?>
<!DOCTYPE HTML>
<META CHARSET="UTF-8">
<html>
	<title>Nuevo Comentario | Blog</title>
	<a href="index.php">Pagina principal</a>
		<form action="ncomentario.php" method="POST" name="comentario2">
			<table width=80% align="center">
				<?php 
					 echo "<tr><td align='center'><h3>".$tema."</h3></td></tr>
				<tr><td><hr></td></tr>
				<tr><td>".$contenidotema."</td></tr>				
				<tr><td><hr></td></tr>";
				 ?>
				<tr><td><i>Añade un nuevo comentario</i></td></tr>
				<tr><td><input type="hidden" name="iddecomentario" value="<?php echo $iddecomentario; ?>"></td></tr>
				<tr><td><input type="hidden" name="idtema" value="<?php echo $_GET['ncomentario']; ?>"></td></tr>
				<tr><td><textarea name="contenido" id="contenido" cols="70" rows="3" placeholder="Presiona para insertar tu texto o contenido"><?php echo $contenido; ?></textarea></td></tr>
				<tr><td align="center"><input type="submit" value="Comentar"></td></tr>
			</table>
		</form>
</html>
<form action="">
