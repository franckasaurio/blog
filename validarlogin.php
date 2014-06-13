<?php 
	$usuario = $_POST["username"];
	$password = $_POST["userpwd"];
	include_once("settings/settings.inc.php");
	$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
	@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());

	$sql_usuarios="SELECT * FROM usuarios WHERE usuario = '$usuario'";
	$rs_usuarios=mysql_query($sql_usuarios, $conexion) or die (mysql_error());
	

//	mysql_num_rows("1");
	$total_usuarios=mysql_num_rows($rs_usuarios);
	if ($total_usuarios==1){
		$row_usuarios = mysql_fetch_array($rs_usuarios);
		if ($row_usuarios["password"]==$password) {
			session_start();
			$t = getdate();
			$_SESSION["id"] = $row_usuarios["id"];
			$_SESSION["usuario"] = $row_usuarios["usuario"];
			$_SESSION["nombre"] = $row_usuarios["nombre"];
			$_SESSION["tipo"] = $row_usuarios["tipo"];
			/* $SESSION["fecha"] = $fecha; */
			header("location:index.php");
		} else {
			header("location:login.php?error=2");
		}
 	} else {
 		header("location:login.php?error=1");
	}

 ?>