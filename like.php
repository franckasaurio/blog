<?php 
	if (isset($_GET['like'])) {
		include_once("settings/settings.inc.php");
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());


		//Revisar que el usuario no haya dado me gusta previamente	
		session_start();
		$sql_like="SELECT * FROM megusta where id_usuario='".$_SESSION['id']."' and id_tema='".$_GET['like']."'";
		$rs_like=mysql_query($sql_like, $conexion) or die (mysql_error());
		$verificarmegusta=mysql_num_rows($rs_like);
			if ($verificarmegusta==0){
				$sql="INSERT INTO megusta (`id_tema`, `id_usuario`, `like`) VALUES ('".$_GET['like']."', '".$_SESSION['id']."', '1');";
				$registro=mysql_query($sql, $conexion) or die(mysql_error());
				header("location:index.php");
			}
			else
				header("location:index.php");
	 }
	 else
	 	header("location:registro.php");

  ?>