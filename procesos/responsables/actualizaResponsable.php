<?php 

session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Responsables.php";

	$obj= new responsables();


	$datos=array(
			$_POST['idresponsableU'],
			$_POST['nombreU'],
			$_POST['apellidoU'],
			$_POST['cargoU'],
			$_POST['telefonoU']
		
				);

	echo $obj->actualizaResponsable($datos);

	
	
 ?>