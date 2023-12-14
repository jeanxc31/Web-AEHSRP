<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Responsables.php";

	$obj= new responsables();

	
	echo $obj->eliminaResponsable($_POST['idresponsable']);
 ?>