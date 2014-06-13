<?php 
 	session_start();
	unset($_SESSION['nombre']);
 	unset ($_SESSION["idusr"]);
	unset ($_SESSION["usuario"]);
	unset ($_SESSION["nombre"]);
	unset ($_SESSION["tipo"]); 
	unset ($_SESSION["id"]); 
	header("location:index.php");
 ?>