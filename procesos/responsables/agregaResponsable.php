<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Responsables.php";

	$obj= new responsables();


	$datos=array(
			$_POST['nombre'],
			$_POST['apellido'],
			$_POST['cargo'],
			$_POST['telefono']

				);

	echo $obj->agregaResponsable($datos);

	
	
 ?>